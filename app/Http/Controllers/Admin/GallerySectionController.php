<?php

namespace App\Http\Controllers\Admin;

use Str;
use Toastr;
use Illuminate\Http\Request;
use App\Models\GallerySection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class GallerySectionController extends Controller
{
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('dashboard.blog', 1);
        $this->route = 'admin.gallery_section';
        $this->view = 'admin.gallery_section';
        $this->path = 'gallery_section';
    }

    public function index()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $data['rows'] = GallerySection::orderBy('id', 'desc')->get();

        return view($this->view . '.index', $data);
    }

    public function create()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;

        // $data['newsletter_direct_videos'] = NewsletterDirectVideo::where('status', '1')->get();

        return view($this->view . '.create', $data);
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for the main image
            'multiple_images' => 'nullable|array',
            'multiple_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for multiple images
            'multiple_videos' => 'nullable|array',
            'multiple_videos.*' => 'mimes:mp4,mkv,avi,webm|max:50000', // Validation for multiple videos
        ]);

        // Handle the main image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = public_path('uploads/gallery_section_images');
            $image->move($imagePath, $imageName);
        } else {
            $imageName = 'default.jpg'; // Default image if not provided
        }

        // Handle multiple images upload
        $multipleImages = [];
        if ($request->hasFile('multiple_images')) {
            foreach ($request->file('multiple_images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = public_path('uploads/gallery_section_images');
                $image->move($imagePath, $imageName);
                $multipleImages[] = 'uploads/gallery_section_images/' . $imageName;
            }
        }

        // Handle multiple videos upload
        $multipleVideos = [];
        if ($request->hasFile('multiple_videos')) {
            foreach ($request->file('multiple_videos') as $video) {
                $videoName = time() . '_' . $video->getClientOriginalName();
                $videoPath = public_path('uploads/gallery_section_videos');
                $video->move($videoPath, $videoName);
                $multipleVideos[] = 'uploads/gallery_section_videos/' . $videoName;
            }
        }

        // Create a new gallery section record
        $gallerySection = new GallerySection();
        $gallerySection->title = $request->input('title');
        $gallerySection->image = 'uploads/gallery_section_images/' . $imageName;
        $gallerySection->multiple_images = json_encode($multipleImages);
        $gallerySection->multiple_videos = json_encode($multipleVideos);
        $gallerySection->status = 1; // You can set this dynamically if needed
        $gallerySection->save();

        // Show success message
        Toastr::success(__('dashboard.created_successfully'), __('dashboard.success'));

        return redirect()->route($this->route . '.index');
    }

    public function show(GallerySection $article, $id)
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

    public function edit(GallerySection $newsletter_photo, $id)
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        // Pass the resolved model as $row
        $data['row'] = $newsletter_photo->find($id);
        $data['newsletter_photos'] = GallerySection::where('status', '1')->get();

        return view($this->view . '.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for the main image
            'multiple_images' => 'nullable|array',
            'multiple_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for multiple images
            'multiple_videos' => 'nullable|array',
            'multiple_videos.*' => 'mimes:mp4,mkv,avi,webm|max:50000', // Validation for multiple videos
        ]);

        // Find the existing gallery section by ID
        $gallerySection = GallerySection::findOrFail($id);

        // Handle the main image upload if provided
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if (is_file(public_path($gallerySection->image))) {
                unlink(public_path($gallerySection->image)); // Remove the old file
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = public_path('uploads/gallery_section_images');
            $image->move($imagePath, $imageName);
            $gallerySection->image = 'uploads/gallery_section_images/' . $imageName;
        }

        // Handle multiple images upload if provided
        $multipleImages = json_decode($gallerySection->multiple_images, true) ?? []; // Existing images
        if ($request->hasFile('multiple_images')) {
            foreach ($request->file('multiple_images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = public_path('uploads/gallery_section_images');
                $image->move($imagePath, $imageName);
                $multipleImages[] = 'uploads/gallery_section_images/' . $imageName;
            }
            $gallerySection->multiple_images = json_encode($multipleImages);
        }

        // Handle multiple videos upload if provided
        $multipleVideos = json_decode($gallerySection->multiple_videos, true) ?? []; // Existing videos
        if ($request->hasFile('multiple_videos')) {
            foreach ($request->file('multiple_videos') as $video) {
                $videoName = time() . '_' . $video->getClientOriginalName();
                $videoPath = public_path('uploads/gallery_section_videos');
                $video->move($videoPath, $videoName);
                $multipleVideos[] = 'uploads/gallery_section_videos/' . $videoName;
            }
            $gallerySection->multiple_videos = json_encode($multipleVideos);
        }

        // Update the gallery section record
        $gallerySection->title = $request->input('title');
        $gallerySection->status = $request->input('status', 1); // Default to 1 (active) if not provided
        $gallerySection->save();

        // Show success message
        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        return redirect()->route($this->route . '.index');
    }

    public function destroy(GallerySection $article, $id)
    {

        $article->find($id)->delete();

        Toastr::success(__('dashboard.deleted_successfully'), __('dashboard.success'));

        return redirect()->back();
    }



}
