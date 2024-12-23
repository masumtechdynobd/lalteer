<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\About;
use Toastr;
use Image;
use File;

class AboutController extends Controller
{
    /**
     * Constructor for initializing class properties.
     */
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('dashboard.about', 1);
        $this->route = 'admin.about';
        $this->view = 'admin.about';
        $this->path = 'about';
    }

    /**
     * Display the about section.
     */
    public function index()
    {
        $data = [
            'title' => $this->title,
            'route' => $this->route,
            'view' => $this->view,
            'path' => $this->path,
            'row' => About::first(),
        ];

        return view($this->view . '.index', $data);
    }

    /**
     * Store or update the about section.
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'title' => 'required|max:191',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video_id' => 'nullable|max:100',
        ]);

        $id = $request->id;
        $path = public_path('uploads/' . $this->path . '/');
        $image1Path = null;
        $image2Path = null;

        // Retrieve the existing `About` instance or create a new one
        $data = $id == -1 ? new About : About::find($id);

        // Handle `image` upload
        if ($request->hasFile('image')) {
            if (!is_null($data->image_path)) {
                $oldImagePath = $path . $data->image_path;
                if (File::isFile($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $image1Path = $filename . '_' . time() . '.' . $extension;

            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            $thumbnailPath = $path . $image1Path;
            Image::make($request->file('image')->getRealPath())->save($thumbnailPath);
        } else {
            $image1Path = $data->image_path ?? null;
        }

        // Handle `image2` upload
        if ($request->hasFile('image2')) {
            if (!is_null($data->image_path2)) {
                $oldImagePath2 = $path . $data->image_path2;
                if (File::isFile($oldImagePath2)) {
                    File::delete($oldImagePath2);
                }
            }

            $filenameWithExt = $request->file('image2')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image2')->getClientOriginalExtension();
            $image2Path = $filename . '_' . time() . '.' . $extension;

            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            $thumbnailPath2 = $path . $image2Path;
            Image::make($request->file('image2')->getRealPath())->save($thumbnailPath2);
        } else {
            $image2Path = $data->image_path2 ?? null;
        }

        // Process content for embedded images
        $processedContent = $this->processContentImages($request->input('description'));

        // Populate fields
        $data->title = $request->title;
        $data->slug = Str::slug($request->title, '-');
        $data->description = $processedContent;
        $data->image_path = $image1Path;
        $data->image_path2 = $image2Path;
        $data->video_id = $request->video_id;
        $data->mission_title = $request->mission_title;
        $data->mission_desc = $request->mission_desc;
        $data->vision_title = $request->vision_title;
        $data->vision_desc = $request->vision_desc;
        $data->features_new = $request->features;
        $data->status = $request->status;

        $data->save();

        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        return redirect()->route($this->route . '.index');
    }

    /**
     * Process content to handle embedded images.
     */
    private function processContentImages($content)
    {
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

                $filepath = "uploads/media/$filename.$mimetype";
                Image::make($src)
                    ->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->encode($mimetype, 100)
                    ->save(public_path($filepath));

                $new_src = asset($filepath);
                $img->setAttribute('src', $new_src);
            }
        }

        return $dom->saveHTML();
    }
}
