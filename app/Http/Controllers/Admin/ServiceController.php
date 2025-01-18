<?php

namespace App\Http\Controllers\Admin;

use File;
use Image;
use Toastr;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CropsCategory;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('dashboard.service', 1);
        $this->route = 'admin.service';
        $this->view = 'admin.service';
        $this->path = 'service';
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

        $data['rows'] = Service::orderBy('id', 'asc')->get();

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
        $data['features'] = Testimonial::orderBy('id', 'desc')->take(3)->get();
        $data['categories'] = CropsCategory::orderBy('id', 'desc')->get();
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
            'title' => 'required|max:191|unique:services,title',
            'short_desc' => 'required',
            'image' => 'required|image',
            'title2' => 'nullable|max:191',
            'description2' => 'nullable',
            'image2' => 'nullable|image',
            'board_of_directory' => 'nullable|in:on',
        ]);

        // Upload `image`
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
                ->fit(800, 500, function ($constraint) {
                    $constraint->upsize();
                })
                ->save($thumbnailpath);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Upload `image2` (if provided)
        if ($request->hasFile('image2')) {
            $filenameWithExt2 = $request->file('image2')->getClientOriginalName();
            $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);
            $extension2 = $request->file('image2')->getClientOriginalExtension();
            $fileNameToStore2 = $filename2 . '_' . time() . '.' . $extension2;

            $path2 = public_path('uploads/' . $this->path . '/');
            if (!File::exists($path2)) {
                File::makeDirectory($path2, 0777, true, true);
            }

            $thumbnailpath2 = $path2 . $fileNameToStore2;
            $img2 = Image::make($request->file('image2')->getRealPath())
                ->fit(800, 500, function ($constraint) {
                    $constraint->upsize();
                })
                ->save($thumbnailpath2);
        } else {
            $fileNameToStore2 = null; // Nullable
        }

        // Handle content for `description`
        $content = $request->input('description');
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->encoding = 'utf-8';
        $dom->loadHtml(utf8_decode($content), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');

            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $filename = uniqid() . '_' . time();
                $path = public_path('uploads/media/');
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }

                $filepath = "/uploads/media/$filename.$mimetype";
                $image = Image::make($src)
                    ->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->encode($mimetype, 100)
                    ->save(public_path($filepath));
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }
        }

        // Check if 'board_of_directory' checkbox is checked (will send 'on' if checked)
        $boardOfDirectory = $request->has('board_of_directory') ? 1 : 0; // 1 for checked, 0 for unchecked
        
        // Insert Data
        $service = new Service;
        $service->title = $request->title;
        $service->slug = Str::slug($request->title, '-');
        $service->short_desc = $request->short_desc;
        $service->description = $dom->saveHTML();
        $service->image_path = $fileNameToStore;

        // New Fields
        $service->title2 = $request->title2;
        $service->description2 = $request->description2;
        $service->image_path2 = $fileNameToStore2;
        $service->feature_id = $request->feature_id;
        $service->category_id = $request->category_id;
        $service->board_of_directory = $boardOfDirectory; // Save the board_of_directory value

        $service->save();

        Toastr::success(__('dashboard.created_successfully'), __('dashboard.success'));

        return redirect()->route($this->route . '.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $data['row'] = $service;

        return view($this->view . '.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $data['row'] = $service;
        $data['features'] = Testimonial::orderBy('id', 'desc')->take(3)->get();
        $data['categories'] = CropsCategory::orderBy('id', 'desc')->get();
        return view($this->view . '.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:services,title,' . $service->id,
            'short_desc' => 'required',
            'description' => 'required',
            'title2' => 'nullable|max:191',
            'description2' => 'nullable',
            'image' => 'nullable|image',
            'image2' => 'nullable|image',
            'board_of_directory' => 'nullable|in:on', // Validate the checkbox input (allows 'on')
        ]);

        // Image upload for the first image
        if ($request->hasFile('image')) {
            $file_path = public_path('uploads/' . $this->path . '/' . $service->image_path);
            if (File::isFile($file_path)) {
                File::delete($file_path);
            }

            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            $path = public_path('uploads/' . $this->path . '/');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            $thumbnailpath = $path . $fileNameToStore;
            $img = Image::make($request->file('image')->getRealPath())->fit(800, 500, function ($constraint) {
                $constraint->upsize();
            })->save($thumbnailpath);
        } else {
            $fileNameToStore = $service->image_path;
        }

        // Image upload for the second image
        if ($request->hasFile('image2')) {
            $file_path2 = public_path('uploads/' . $this->path . '/' . $service->image2_path);
            if (File::isFile($file_path2)) {
                File::delete($file_path2);
            }

            $filenameWithExt2 = $request->file('image2')->getClientOriginalName();
            $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);
            $extension2 = $request->file('image2')->getClientOriginalExtension();
            $fileNameToStore2 = $filename2 . '_' . time() . '.' . $extension2;

            $path2 = public_path('uploads/' . $this->path . '/');
            if (!File::exists($path2)) {
                File::makeDirectory($path2, 0777, true, true);
            }

            $thumbnailpath2 = $path2 . $fileNameToStore2;
            $img2 = Image::make($request->file('image2')->getRealPath())->fit(800, 500, function ($constraint) {
                $constraint->upsize();
            })->save($thumbnailpath2);
        } else {
            $fileNameToStore2 = $service->image2_path;
        }

        // Get content with media file
        $content = $request->input('description');
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->encoding = 'utf-8';
        $dom->loadHtml(utf8_decode($content), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');

            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $filename = uniqid() . '_' . time();

                $path = public_path('uploads/media/');
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }

                $filepath = "/uploads/media/$filename.$mimetype";
                $image = Image::make($src)
                    ->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->encode($mimetype, 100)
                    ->save(public_path($filepath));

                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }
        }

        // Check if 'board_of_directory' checkbox is checked (will send 'on' if checked)
        $boardOfDirectory = $request->has('board_of_directory') ? 1 : 0; // 1 for checked, 0 for unchecked

        // Update Data
        $service->title = $request->title;
        $service->slug = Str::slug($request->title, '-');
        $service->short_desc = $request->short_desc;
        $service->description = $dom->saveHTML();
        $service->image_path = $fileNameToStore;
        $service->image_path2 = $fileNameToStore2; // Save second image path
        $service->title2 = $request->title2; // Save second title
        $service->description2 = $request->description2; // Save second description
        $service->feature_id = $request->feature_id;
        $service->category_id = $request->category_id;
        $service->status = 1;
        $service->board_of_directory = $boardOfDirectory; // Save the board_of_directory value
        $service->save();

        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $image_path = public_path('uploads/' . $this->path . '/' . $service->image_path);
        if (File::isFile($image_path)) {
            File::delete($image_path);
        }

        if ($service->image2) {
            $image2_path = public_path('uploads/' . $this->path . '/' . $service->image2);
            if (File::isFile($image2_path)) {
                File::delete($image2_path);
            }
        }

        $service->delete();
        Toastr::success(__('dashboard.deleted_successfully'), __('dashboard.success'));
        return redirect()->back();
    }
}