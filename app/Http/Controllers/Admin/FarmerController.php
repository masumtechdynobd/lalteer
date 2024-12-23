<?php

namespace App\Http\Controllers\Admin;

use File;
use Image;
use Toastr;
use App\Models\Farmer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FarmerController extends Controller
{
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('dashboard.farmer', 1);
        $this->route = 'admin.farmer';
        $this->view = 'admin.farmer';
        $this->path = 'farmer';
    }
    public function index()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $data['rows'] = Farmer::orderBy('id', 'desc')->get();

        return view($this->view . '.index', $data);
    }
    public function store(Request $request)
    {
        // Field Validation
        $request->validate([
            'title' => 'required|max:191',
            'description' => 'required',
            'image' => 'required|image',
            'multiple_images' => 'nullable|array', // Allow multiple images
            'multiple_images.*' => 'image', // Each file in the array should be an image
        ]);

        // Image upload for the main image
        if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            $path = public_path('uploads/' . $this->path . '/');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            $thumbnailpath = $path . $fileNameToStore;
            $img = Image::make($request->file('image')->getRealPath())
                ->save($thumbnailpath);
        } else {
            $fileNameToStore = 'noimage.jpg'; // Default image if none is uploaded
        }

        // Handle multiple images upload
        $multipleImagePaths = [];
        if ($request->hasFile('multiple_images')) {
            foreach ($request->file('multiple_images') as $image) {
                $filenameWithExt = $image->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $mulfileNameToStore = $filename . '_' . time() . '.' . $extension;

                $path = public_path('uploads/' . $this->path . '/');
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }

                $imagePath = $path . $mulfileNameToStore;
                Image::make($image->getRealPath())->save($imagePath);

                // Store the file paths for multiple images
                $multipleImagePaths[] = $mulfileNameToStore;
            }
        }

        // Insert Data
        $research = new Farmer();
        $research->title = $request->title;
        $research->title2 = $request->title2;
        $research->slug = Str::slug($request->title, '-');
        $research->description = $request->description;
        $research->description2 = $request->description2; // Save the second description
        $research->image_path = $fileNameToStore;
        $research->multiple_images = json_encode($multipleImagePaths); // Save the paths as a JSON string
        $research->save();

        Toastr::success(__('dashboard.created_successfully'), __('dashboard.success'));

        return redirect()->back();
    }

    public function update(Request $request, Farmer $farmer)
    {
        // Field Validation
        $request->validate([
            'title' => 'required|max:191',
            'description' => 'required',
            'description2' => 'nullable|string',
            'image' => 'nullable|image', // Single image validation
            'multiple_images' => 'nullable|array', // Allow multiple images
            'multiple_images.*' => 'nullable|image', // Each file in the array should be an image
        ]);

        // Handle single image upload
        if ($request->hasFile('image')) {
            $file_path = public_path('uploads/' . $this->path . '/' . $farmer->image_path);
            if (File::isFile($file_path)) {
                File::delete($file_path); // Delete old image if it exists
            }

            // Upload New Image
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            // Create Folder Location
            $path = public_path('uploads/' . $this->path . '/');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            // Resize and Save Image (optional resizing step)
            $thumbnailpath = $path . $fileNameToStore;
            Image::make($request->file('image')->getRealPath())->save($thumbnailpath);
        } else {
            $fileNameToStore = $farmer->image_path; // Keep the old image if no new one is uploaded
        }

        // Handle multiple images upload
        $multipleImagePaths = [];
        if ($request->hasFile('multiple_images')) {
            foreach ($request->file('multiple_images') as $image) {
                $filenameWithExt = $image->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $mulfileNameToStore = $filename . '_' . time() . '.' . $extension;

                $path = public_path('uploads/' . $this->path . '/');
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }

                $imagePath = $path . $mulfileNameToStore;
                Image::make($image->getRealPath())->save($imagePath);

                // Store the file paths for multiple images
                $multipleImagePaths[] = $mulfileNameToStore;
            }
        }

        // Update Data
        $farmer->title = $request->title;
        $farmer->title2 = $request->title2;
        $farmer->slug = Str::slug($request->title, '-');
        $farmer->description = $request->description;
        $farmer->description2 = $request->description2; // Update second description
        $farmer->image_path = $fileNameToStore;

        // If multiple images were uploaded, store the paths as a JSON string
        if (!empty($multipleImagePaths)) {
            $farmer->multiple_images = json_encode($multipleImagePaths);
        }

        $farmer->save();

        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        return redirect()->back();
    }

    public function destroy(Farmer $farmer)
    {
        // Delete the first image if it exists
        if ($farmer->image_path) {
            $image_path = public_path('uploads/' . $this->path . '/' . $farmer->image_path);
            if (File::isFile($image_path)) {
                File::delete($image_path); // Delete the image
            }
        }

        // Optionally, delete the images from the multiple_images field if it's set
        if ($farmer->multiple_images) {
            $images = json_decode($farmer->multiple_images, true);
            foreach ($images as $image) {
                $image_path = public_path('uploads/' . $this->path . '/' . $image);
                if (File::isFile($image_path)) {
                    File::delete($image_path); // Delete each image
                }
            }
        }

        // Delete the ResearchAndDevelop record
        $farmer->delete();

        // Display success message using Toastr
        Toastr::success(__('dashboard.deleted_successfully'), __('dashboard.success'));

        // Redirect back to the previous page
        return redirect()->back();
    }
}