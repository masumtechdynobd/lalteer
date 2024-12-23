<?php

namespace App\Http\Controllers\Admin;

use File;
use Image;
use Toastr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CropsCategory;
use App\Http\Controllers\Controller;

class CropsCategoryController extends Controller
{
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('dashboard.category', 1);
        $this->route = 'admin.category';
        $this->view = 'admin.category';
        $this->path = 'category';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $data['rows'] = CropsCategory::orderBy('id', 'desc')->get();

        return view($this->view . '.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Field Validation
        $request->validate([
            'title' => 'required|max:191',

        ]);


        // image upload, fit and store inside public folder 
        if ($request->hasFile('image')) {
            //Upload New Image
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            //Crete Folder Location
            $path = public_path('uploads/' . $this->path . '/');
            if (! File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            //Resize And Crop as Fit image here (200 width, 270 height)
            $thumbnailpath = $path . $fileNameToStore;
            $img = Image::make($request->file('image')->getRealPath())
                ->save($thumbnailpath);
        } else {
            $fileNameToStore = 'noimage.jpg'; // if no image selected this will be the default image
        }


        // Insert Data
        $testimonial = new CropsCategory();
        $testimonial->title = $request->title;
        $testimonial->slug = Str::slug($request->title, '-');

        $testimonial->description = $request->description;
        $testimonial->image_path = $fileNameToStore;
        $testimonial->save();


        Toastr::success(__('dashboard.created_successfully'), __('dashboard.success'));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CropsCategory $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CropsCategory $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CropsCategory $category)
    {
        // Field Validation
        $request->validate([
            'title' => 'required|max:191' . $category->id,

        ]);


        // image upload, fit and store inside public folder 
        if ($request->hasFile('image')) {

            $file_path = public_path('uploads/' . $this->path . '/' . $category->image_path);
            if (File::isFile($file_path)) {
                File::delete($file_path);
            }

            //Upload New Image
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            //Crete Folder Location
            $path = public_path('uploads/' . $this->path . '/');
            if (! File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            //Resize And Crop as Fit image here (200 width, 270 height)
            $thumbnailpath = $path . $fileNameToStore;
            $img = Image::make($request->file('image')->getRealPath())
                ->save($thumbnailpath);
        } else {

            $fileNameToStore = $category->image_path;
        }


        // Update Data
        $category->title = $request->title;
        $category->slug = Str::slug($request->title, '-');
        $category->designation = $request->designation;
        $category->organization = $request->organization;
        $category->description = $request->description;
        $category->image_path = $fileNameToStore;
        $category->status = $request->status;
        $category->save();


        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CropsCategory $category)
    {
        // Delete Data
        $image_path = public_path('uploads/' . $this->path . '/' . $testimonial->image_path);
        if (File::isFile($image_path)) {
            File::delete($image_path);
        }

        $testimonial->delete();

        Toastr::success(__('dashboard.deleted_successfully'), __('dashboard.success'));

        return redirect()->back();
    }
}