<?php

namespace App\Http\Controllers\Admin;

use File;
use Image;
use Toastr;
use App\Models\Member;
use App\Models\Designation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('dashboard.member', 1);
        $this->route = 'admin.member';
        $this->view = 'admin.member';
        $this->path = 'member';
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

        $data['rows'] = Member::orderBy('id', 'asc')->get();

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
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;

        $data['designations'] = Designation::where('status', '1')->get();

        return view($this->view . '.create', $data);
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
            'title' => 'required|max:191|unique:members,title',
            'designation' => 'required',
            'image' => 'required|image',
            'board_of_directory' => 'nullable|in:on', // Validate the new field (optional)
        ]);

        // image upload, fit and store inside public folder 
        if ($request->hasFile('image')) {
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

            // Resize and Crop image here (400 width, 500 height)
            $thumbnailpath = $path . $fileNameToStore;
            $img = Image::make($request->file('image')->getRealPath())
                ->fit(140, 140, function ($constraint) {
                    $constraint->upsize();
                })
                ->save($thumbnailpath);
        } else {
            $fileNameToStore = 'noimage.jpg'; // If no image selected, use default image
        }

        // Check if 'board_of_directory' checkbox is checked (will send 'on' if checked)
        $boardOfDirectory = $request->has('board_of_directory') ? 1 : 0; // 1 for checked, 0 for unchecked

        // Insert Data
        $member = new Member;
        $member->title = $request->title;
        $member->slug = Str::slug($request->title, '-');
        $member->designation_id = $request->designation;
        $member->description = $request->description;
        $member->image_path = $fileNameToStore;
        $member->facebook = $request->facebook;
        $member->twitter = $request->twitter;
        $member->instagram = $request->instagram;
        $member->linkedin = $request->linkedin;
        $member->email = $request->email;
        $member->phone = $request->phone;
        $member->whatsapp = $request->whatsapp;
        $member->website = $request->website;
        $member->board_of_directory = $boardOfDirectory; // Save the board_of_directory value
        $member->save();

        Toastr::success(__('dashboard.created_successfully'), __('dashboard.success'));

        return redirect()->route($this->route . '.index');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $data['row'] = $member;

        return view($this->view . '.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $data['row'] = $member;
        $data['designations'] = Designation::where('status', '1')->get();

        return view($this->view . '.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:members,title,' . $member->id,
            'designation' => 'required',
            'image' => 'nullable|image',
            'board_of_directory' => 'nullable|in:on', // Validate the checkbox input (allows 'on')
        ]);

        // image upload, fit and store inside public folder 
        if ($request->hasFile('image')) {

            // Delete existing image if it exists
            $file_path = public_path('uploads/' . $this->path . '/' . $member->image_path);
            if (File::isFile($file_path)) {
                File::delete($file_path);
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

            // Resize and Crop image
            $thumbnailpath = $path . $fileNameToStore;
            $img = Image::make($request->file('image')->getRealPath())
                ->fit(140, 140, function ($constraint) {
                    $constraint->upsize();
                })
                ->save($thumbnailpath);
        } else {
            $fileNameToStore = $member->image_path; // If no new image selected, retain old one
        }

        // Check if 'board_of_directory' checkbox is checked (will send 'on' if checked)
        $boardOfDirectory = $request->has('board_of_directory') ? 1 : 0; // 1 for checked, 0 for unchecked

        // Update Data
        $member->title = $request->title;
        $member->slug = Str::slug($request->title, '-');
        $member->designation_id = $request->designation;
        $member->description = $request->description;
        $member->image_path = $fileNameToStore;
        $member->facebook = $request->facebook;
        $member->twitter = $request->twitter;
        $member->instagram = $request->instagram;
        $member->linkedin = $request->linkedin;
        $member->email = $request->email;
        $member->phone = $request->phone;
        $member->whatsapp = $request->whatsapp;
        $member->website = $request->website;
        $member->status = $request->status;
        $member->board_of_directory = $boardOfDirectory; // Save the board_of_directory value
        $member->save();

        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        // Delete Data
        $image_path = public_path('uploads/' . $this->path . '/' . $member->image_path);
        if (File::isFile($image_path)) {
            File::delete($image_path);
        }

        $member->delete();

        Toastr::success(__('dashboard.deleted_successfully'), __('dashboard.success'));

        return redirect()->back();
    }
}
