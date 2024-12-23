<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use Toastr;
use Image;
use File;


class SectionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('dashboard.section', 1);
        $this->route = 'admin.section';
        $this->view = 'admin.section';
        $this->path = 'section';
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

        $data['rows'] = Section::orderBy('id', 'asc')->get();

        return view($this->view . '.index', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:sections,title,' . $section->id,
        ]);

        if ($request->status == 1) {
            $status = 1;
        } else {
            $status = 0;
        }
        if ($request->hasFile('image')) {

            $file_path = public_path('uploads/' . $this->path . '/' . $section->image_path);
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

            $fileNameToStore = $section->image_path;
        }

        // Update Data
        $section->title = $request->title;
        $section->description = $request->description;
        $section->icon = $request->icon;
        $section->image_path = $fileNameToStore;
        $section->status = $status;
        $section->save();


        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        return redirect()->back();
    }
}