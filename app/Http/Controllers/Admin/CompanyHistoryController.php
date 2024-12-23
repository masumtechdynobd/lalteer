<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CompanyHistory;
use App\Http\Controllers\Controller;
use File;
use Image;
use Toastr;

class CompanyHistoryController extends Controller
{
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('dashboard.history', 1);
        $this->route = 'admin.history';
        $this->view = 'admin.history';
        $this->path = 'history';
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

        $data['rows'] = CompanyHistory::orderBy('id', 'desc')->get();

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
            'description' => 'required',
            'image' => 'required',
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
        $testimonial = new CompanyHistory();
        $testimonial->title = $request->title;
        $testimonial->slug = Str::slug($request->title, '-');
        $testimonial->designation = $request->designation;
        $testimonial->organization = $request->organization;
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
    public function show(CompanyHistory $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyHistory $history)
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
    public function update(Request $request, CompanyHistory $history)
    {
        // Field Validation
        $request->validate([
            'title' => 'required|max:191' . $history->id,
            'description' => 'required',
            'image' => 'nullable',
        ]);


        // image upload, fit and store inside public folder 
        if ($request->hasFile('image')) {

            $file_path = public_path('uploads/' . $this->path . '/' . $history->image_path);
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

            $fileNameToStore = $history->image_path;
        }


        // Update Data
        $history->title = $request->title;
        $history->slug = Str::slug($request->title, '-');
        $history->designation = $request->designation;
        $history->organization = $request->organization;
        $history->description = $request->description;
        $history->image_path = $fileNameToStore;
        $history->status = 1;
        $history->save();


        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyHistory $history)
    {
        // Delete Data
        $image_path = public_path('uploads/' . $this->path . '/' . $history->image_path);
        if (File::isFile($image_path)) {
            File::delete($image_path);
        }

        $history->delete();

        Toastr::success(__('dashboard.deleted_successfully'), __('dashboard.success'));

        return redirect()->back();
    }
}
