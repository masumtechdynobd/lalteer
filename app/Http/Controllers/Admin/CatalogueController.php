<?php

namespace App\Http\Controllers\Admin;

use Str;
use Toastr;
use App\Models\Catalogue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File; // Import Toastr (if you're using this package)
use Intervention\Image\Facades\Image;

class CatalogueController extends Controller
{
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('dashboard.blog', 1);
        $this->route = 'admin.catalogue';
        $this->view = 'admin.catalogue';
        $this->path = 'catalogue';
    }

    public function index()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $data['rows'] = Catalogue::orderBy('id', 'desc')->get();

        return view($this->view . '.index', $data);
    }

    public function create()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;

        $data['newsletter_photos'] = Catalogue::where('status', '1')->get();

        return view($this->view . '.create', $data);
    }


    public function store(Request $request)
    {
        // Validate the image input
        $request->validate([
            'photos_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for the image
        ]);

        // Handle the file upload
        if ($request->hasFile('photos_path')) {
            // Get the original filename and extension
            $filenameWithExt = $request->file('photos_path')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photos_path')->getClientOriginalExtension();

            // Create a unique filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            // Create the upload directory if it doesn't exist
            $path = public_path('uploads/catalogue/');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            // Resize and save the image using Intervention Image
            $thumbnailPath = $path . $fileNameToStore;
            $img = Image::make($request->file('photos_path')->getRealPath())
                ->resize(448, 420, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save($thumbnailPath);
        } else {
            $fileNameToStore = 'noimage.jpg'; // Default placeholder if no file is uploaded
        }

        // Optional: Save the file path to the database
        // Replace `NewsletterPhoto` with your model name if necessary
        $newsletterPhoto = new Catalogue();
        $newsletterPhoto->photos_path = 'uploads/catalogue/' . $fileNameToStore;
        $newsletterPhoto->save();

        // Display success message
        Toastr::success(__('dashboard.image uploaded successfully'), __('dashboard.success'));

        // Redirect back
        return redirect()->route($this->route . '.index');
    }

    public function show(Catalogue $article, $id)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        // dd($article->first());
        if ($id) {
            $data['row'] = $article->find($id);
        }

        return view($this->view . '.show', $data);
    }



    public function edit(Catalogue $newsletter_photo, $id)
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        // Pass the resolved model as $row
        $data['row'] = $newsletter_photo->find($id);

        return view($this->view . '.edit', $data);
    }


    public function update(Request $request, $id)
    {
        // Validate the image input
        $request->validate([
            'photos_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for the image
        ]);

        // Find the existing record by ID
        $catalogue = Catalogue::findOrFail($id);

        // Handle the file upload if a new file is provided
        if ($request->hasFile('photos_path')) {
            // Delete the old image if it exists
            $oldImagePath = public_path($catalogue->photos_path);
            if (File::exists($oldImagePath) && $catalogue->photos_path != 'noimage.jpg') {
                File::delete($oldImagePath);
            }

            // Get the original filename and extension
            $filenameWithExt = $request->file('photos_path')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photos_path')->getClientOriginalExtension();

            // Create a unique filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            // Create the upload directory if it doesn't exist
            $path = public_path('uploads/catalogue/');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            // Resize and save the image using Intervention Image
            $thumbnailPath = $path . $fileNameToStore;
            $img = Image::make($request->file('photos_path')->getRealPath())
                ->resize(448, 420, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save($thumbnailPath);

            // Update the path in the database
            $catalogue->photos_path = 'uploads/catalogue/' . $fileNameToStore;
        }

        // Save the updated record
        $catalogue->save();

        // Display success message
        Toastr::success(__('dashboard.image updated successfully'), __('dashboard.success'));

        // Redirect back
        return redirect()->route($this->route . '.index');
    }



    public function destroy(Catalogue $article, $id)
    {
        // Delete Data
        $photos_path = public_path('uploads/' . $this->path . '/' . $article->photos_path);
        if (File::isFile($photos_path)) {
            File::delete($photos_path);
        }

        $article->find($id)->delete();

        Toastr::success(__('dashboard.deleted_successfully'), __('dashboard.success'));

        return redirect()->back();
    }
}
