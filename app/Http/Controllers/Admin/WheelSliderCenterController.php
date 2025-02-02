<?php

namespace App\Http\Controllers\Admin;

use Str;
use Toastr;
use Illuminate\Http\Request;
use App\Models\WheelSliderCenter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File; // Import Toastr (if you're using this package)
use Intervention\Image\Facades\Image;

class WheelSliderCenterController extends Controller
{
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('dashboard.blog', 1);
        $this->route = 'admin.wheel_slider_center';
        $this->view = 'admin.wheel_slider_center';
        $this->path = 'wheel_slider_center';
    }

    public function index()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $data['rows'] = WheelSliderCenter::orderBy('id', 'desc')->get();

        return view($this->view . '.index', $data);
    }

    public function create()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;

        $data['newsletter_photos'] = WheelSliderCenter::where('status', '1')->get();

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
            $path = public_path('uploads/wheel_slider_center/');
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
        $newsletterPhoto = new WheelSliderCenter();
        $newsletterPhoto->photos_path = 'uploads/wheel_slider_center/' . $fileNameToStore;
        $newsletterPhoto->save();

        // Display success message
        Toastr::success(__('dashboard.image uploaded successfully'), __('dashboard.success'));

        // Redirect back
        return redirect()->route($this->route . '.index');
    }

    public function show(WheelSliderCenter $article, $id)
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



    public function edit(WheelSliderCenter $newsletter_photo)
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        // Pass the resolved model as $row
        $data['row'] = $newsletter_photo;
        $data['newsletter_photos'] = WheelSliderCenter::where('status', '1')->get();

        return view($this->view . '.edit', $data);
    }


    public function update(Request $request, WheelSliderCenter $newsletterPhoto)
    {
        // Validate the image input
        $request->validate([
            'photos_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is optional for update
        ]);

        // Handle image upload if a new file is provided
        if ($request->hasFile('photos_path')) {
            // Delete the old image if it exists
            $oldFilePath = public_path($newsletterPhoto->photos_path);
            if (File::exists($oldFilePath) && $newsletterPhoto->photos_path !== 'uploads/wheel_slider_center/noimage.jpg') {
                File::delete($oldFilePath);
            }

            // Process the new file upload
            $filenameWithExt = $request->file('photos_path')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photos_path')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            // Create the upload directory if it doesn't exist
            $path = public_path('uploads/wheel_slider_center/');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            // Resize and save the image
            $thumbnailPath = $path . $fileNameToStore;
            $img = Image::make($request->file('photos_path')->getRealPath())
                ->resize(448, 420, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save($thumbnailPath);

            // Update the database path
            $newsletterPhoto->photos_path = 'uploads/wheel_slider_center/' . $fileNameToStore;
        }

        // If no new image is uploaded, keep the current image
        // No action needed here since `$newsletterPhoto->photos_path` already contains the existing value

        // Save the updated data
        $newsletterPhoto->save();

        // Display success message
        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        // Redirect back
        return redirect()->route($this->route . '.index');
    }


    public function destroy(WheelSliderCenter $article, $id)
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
