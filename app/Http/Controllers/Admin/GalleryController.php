<?php

namespace App\Http\Controllers\Admin;

use Str;
use Toastr;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('dashboard.blog', 1);
        $this->route = 'admin.gallery';
        $this->view = 'admin.gallery';
        $this->path = 'gallery';
    }

    public function index()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $data['rows'] = Gallery::orderBy('id', 'desc')->get();

        return view($this->view . '.index', $data);
    }

    public function create()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;

        $data['newsletter_photos'] = Gallery::where('status', '1')->get();

        return view($this->view . '.create', $data);
    }

    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'text' => 'required|string|max:255', // Validation for text input
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
            $path = public_path('uploads/gallery/'); // Replace 'gallery_photos' with your desired directory
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

        // Save the data to the database
        $gallery = new Gallery(); // Replace `Gallery` with your actual model name
        $gallery->text = $request->text;
        $gallery->photos_path = 'uploads/gallery/' . $fileNameToStore;
        $gallery->status = 1; // Default to active status
        $gallery->save();

        // Display a success message
        Toastr::success(__('dashboard.image uploaded successfully'), __('dashboard.success'));

        // Redirect back to the index page
        return redirect()->route($this->route . '.index');
    }

    public function show(Gallery $article, $id)
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

    public function edit(Gallery $gallery)
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        // Pass the resolved model as $row
        $data['row'] = $gallery;
        $data['gallery'] = Gallery::where('status', '1')->get();

        return view($this->view . '.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'text' => 'required|string|max:255', // Validation for text input
            'photos_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for the image (optional for update)
        ]);

        // Find the gallery record by id
        $gallery = Gallery::findOrFail($id);

        // Update the text
        $gallery->text = $request->text;

        // Handle the file upload if a new file is provided
        if ($request->hasFile('photos_path')) {
            // Delete the old image if it exists and is not the default image
            if (is_file(public_path($gallery->photos_path)) && $gallery->photos_path != 'noimage.jpg') {
                unlink(public_path($gallery->photos_path));
            }

            // Get the original filename and extension
            $filenameWithExt = $request->file('photos_path')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photos_path')->getClientOriginalExtension();

            // Create a unique filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            // Create the upload directory if it doesn't exist
            $path = public_path('uploads/gallery/'); // Replace 'gallery' with your desired directory
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

            // Update the photos_path field
            $gallery->photos_path = 'uploads/gallery/' . $fileNameToStore;
        }

        // Save the updated record
        $gallery->save();

        // Display a success message
        Toastr::success(__('dashboard.image updated successfully'), __('dashboard.success'));

        // Redirect back to the index page
        return redirect()->route($this->route . '.index');
    }

    public function destroy($id)
    {
       // Find the video record by ID
       $gallery = Gallery::findOrFail($id);

       // Delete the record from the database
       $gallery->delete();

       // Show a success message
       Toastr::success(__('dashboard.deleted_successfully'), __('dashboard.success'));

       return redirect()->back();
    }




}
