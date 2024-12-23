<?php

namespace App\Http\Controllers\Admin;

use App\Models\Variety;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Toastr;
use Image;
use File;
use Auth;
use Hash;

class VarietyController extends Controller
{
    //
    public function index()
    {
        $varieties = Variety::all();
        return view('admin.varieties.index', compact('varieties'));
    }
    public function create()
    {
        $crops = Service::all();
        return view('admin.varieties.create', compact('crops'));
    }
    // Store a new variety
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image',
            'title' => 'required|string',
            'breeder_name' => 'required|string',
            'crop_id' => 'required',
        ]);

        // Process image upload
        if ($request->hasFile('image')) {
            // Get the file information
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();

            // Generate a unique filename to avoid conflicts
            $imageNameToStore = $filename . '_' . time() . '.' . $extension;

            // Define the storage path (you can use your existing 'public' storage)
            $path = public_path('uploads/varieties/');

            // Create the directory if it doesn't exist
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            // Save the image
            $imagePath = $path . $imageNameToStore;
            $img = Image::make($request->file('image')->getRealPath())->save($imagePath);

            // Alternatively, if you prefer using Laravel's built-in storage
            // $imagePath = $request->file('image')->storeAs('images/varieties', $imageNameToStore, 'public');
        }

        // Create a new Variety record
        Variety::create([
            'image' => $imageNameToStore, // Store the image name, not the full path
            'title' => $request->title,
            'breeder_name' => $request->breeder_name,
            'color' => $request->color,
            'weight' => $request->weight,
            'rate' => $request->rate,
            'showing_time' => $request->showing_time,
            'yield' => $request->yield,
            'maturity' => $request->maturity,
            'crop_id' => $request->crop_id,
        ]);

        Toastr::success('Variety created successfully!', 'Success');
        return redirect()->route('admin.varieties.index');
    }


    // Show the form to edit a variety
    public function edit(Variety $variety)
    {
        $crops = Service::all();
        return view('admin.varieties.edit', compact('variety', 'crops'));
    }

    // Update the variety
    public function update(Request $request, Variety $variety)
    {
        $validated = $request->validate([
            'image' => 'nullable|image',
            'title' => 'required|string',
            'breeder_name' => 'required|string',
            'crop_id' => 'required',
        ]);

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Find the existing variety record and delete the old image if exists
            if ($variety->image) {
                $oldImagePath = public_path('uploads/varieties/' . $variety->image); // Old image path
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);  // Delete the old image
                }
            }

            // Get the new image details
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageNameToStore = $filename . '_' . time() . '.' . $extension;  // Create unique filename with timestamp

            // Define the path where the image will be stored
            $path = public_path('uploads/varieties/');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true); // Create directory if not exists
            }

            // Store the image
            $imagePath = $path . $imageNameToStore;
            $image = Image::make($request->file('image')->getRealPath()); // Create an image instance
            $image->save($imagePath); // Save the image to the defined path

            // Update the image in the database
            $variety->update(['image' => $imageNameToStore]);
        }

        // Update other fields in the variety record
        $variety->update([
            'title' => $request->title,
            'breeder_name' => $request->breeder_name,

            'crop_id' => $request->crop_id,
        ]);

        // Success message and redirect
        Toastr::success('Variety updated successfully!', 'Success');
        return redirect()->route('admin.varieties.index');
    }


    // Delete a variety
    public function destroy(Variety $variety)
    {
        // Delete the image file if it exists
        $image_path = public_path('storage/' . $variety->image);  // Path to the image
        if (file_exists($image_path)) {
            unlink($image_path);  // Delete the image file
        }

        // Delete the variety record from the database
        $variety->delete();

        // Success message and redirect
        Toastr::success('Variety deleted successfully!', 'Success');
        return redirect()->route('admin.varieties.index');
    }
}
