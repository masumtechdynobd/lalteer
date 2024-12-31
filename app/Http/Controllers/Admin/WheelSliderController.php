<?php

namespace App\Http\Controllers\Admin;

use Str;
use Toastr;
use App\Models\WheelSlider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File; // Import Toastr (if you're using this package)
use Intervention\Image\Facades\Image;

class WheelSliderController extends Controller
{
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('dashboard.blog', 1);
        $this->route = 'admin.wheel_slider';
        $this->view = 'admin.wheel_slider';
        $this->path = 'wheel_slider';
    }

    public function index()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $data['rows'] = WheelSlider::orderBy('id', 'desc')->get();

        return view($this->view . '.index', $data);
    }

    public function create()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;

        $data['newsletter_photos'] = WheelSlider::where('status', '1')->get();

        return view($this->view . '.create', $data);
    }


    public function store(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'photos_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for the image
            'title' => 'required|string|max:255', // Validation for title
            'description' => 'nullable|string', // Validation for description
        ]);
    
        // Handle the file upload
        $fileNameToStore = 'noimage.jpg'; // Default placeholder if no file is uploaded
        if ($request->hasFile('photos_path')) {
            // Get the original filename and extension
            $filenameWithExt = $request->file('photos_path')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photos_path')->getClientOriginalExtension();
    
            // Create a unique filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
    
            // Create the upload directory if it doesn't exist
            $path = public_path('uploads/wheel_slider/');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
    
            // Resize and save the image using Intervention Image
            $thumbnailPath = $path . $fileNameToStore;
            Image::make($request->file('photos_path')->getRealPath())
                ->resize(448, 420, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save($thumbnailPath);
        }
    
        // Save the data to the database
        $newsletterPhoto = new WheelSlider();
        $newsletterPhoto->photos_path = 'uploads/wheel_slider/' . $fileNameToStore;
        $newsletterPhoto->title = $request->title;
        $newsletterPhoto->description = $request->description;
        $newsletterPhoto->save();
    
        // Display success message
        Toastr::success(__('dashboard.image uploaded successfully'), __('dashboard.success'));
    
        // Redirect back
        return redirect()->route($this->route . '.index');
    }


    public function show(WheelSlider $article, $id)
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



    public function edit(WheelSlider $newsletter_photo, $id)
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        // Pass the resolved model as $row
        $data['row'] = $newsletter_photo->find($id);
        $data['newsletter_photos'] = WheelSlider::where('status', '1')->get();

        return view($this->view . '.edit', $data);
    }


    public function update(Request $request, $id)
{
    // Retrieve the existing record
    $newsletterPhoto = WheelSlider::findOrFail($id); // This ensures we get the existing record

    // Validate the input fields
    $request->validate([
        'photos_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is optional for update
        'title' => 'required|string|max:255', // Validation for title
        'description' => 'nullable|string', // Validation for description
    ]);

    // Handle the file upload if a new image is provided
    if ($request->hasFile('photos_path')) {
        // Delete the old image if it exists and is not the default placeholder
        $oldFilePath = public_path($newsletterPhoto->photos_path);
        if (File::exists($oldFilePath) && $newsletterPhoto->photos_path !== 'uploads/wheel_slider/noimage.jpg') {
            File::delete($oldFilePath);
        }

        // Get the original filename and extension
        $filenameWithExt = $request->file('photos_path')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('photos_path')->getClientOriginalExtension();

        // Create a unique filename to store
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;

        // Create the upload directory if it doesn't exist
        $path = public_path('uploads/wheel_slider/');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        // Resize and save the image using Intervention Image
        $thumbnailPath = $path . $fileNameToStore;
        Image::make($request->file('photos_path')->getRealPath())
            ->resize(448, 420, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->save($thumbnailPath);

        // Update the new image path in the database
        $newsletterPhoto->photos_path = 'uploads/wheel_slider/' . $fileNameToStore;
    }

    // Update title and description
    $newsletterPhoto->title = $request->title;
    $newsletterPhoto->description = $request->description;

    // Save the updated data
    $newsletterPhoto->save();

    // Display success message
    Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

    // Redirect back
    return redirect()->route($this->route . '.index');
}








    public function destroy(WheelSlider $article, $id)
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
