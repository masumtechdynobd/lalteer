<?php

namespace App\Http\Controllers\Admin;

use Str;
use Toastr;
use Illuminate\Http\Request;
use App\Models\NewsletterVideos;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File; // Import Toastr (if you're using this package)
use Intervention\Image\Facades\Image;

class NewsletterVideosContoller extends Controller
{
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('dashboard.blog', 1);
        $this->route = 'admin.newsletter_videos';
        $this->view = 'admin.newsletter_videos';
        $this->path = 'newsletter_videos';
    }

    public function index()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $data['rows'] = NewsletterVideos::orderBy('id', 'desc')->get();


        return view($this->view . '.index', $data);
    }

    public function create()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;

        $data['newsletter_videos'] = NewsletterVideos::where('status', '1')->get();

        return view($this->view . '.create', $data);
    }

    public function store(Request $request)
    {
        // Validate the YouTube URL
        $request->validate([
            'youtube_video_id' => 'required|url',
        ]);

        // Get the YouTube video URL from the form input
        $youtubeUrl = $request->input('youtube_video_id');

        // Extract the YouTube video ID from the URL using a regex
        preg_match('/(?:https?:\/\/(?:www\.)?youtube\.com\/(?:[^\/\n\s]+\/\S+|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $youtubeUrl, $matches);

        // Check if the video ID is valid
        if (!isset($matches[1])) {
            Toastr::error(__('dashboard.invalid_video_link'), __('dashboard.error'));
            return redirect()->back();
        }

        // Get the extracted video ID
        $videoId = $matches[1];

        // Insert the video ID into the database
        $newsletterVideo = new NewsletterVideos();
        $newsletterVideo->youtube_video_id = $videoId;
        $newsletterVideo->save();

        // Show a success message
        Toastr::success(__('dashboard.created_successfully'), __('dashboard.success'));

        return redirect()->route($this->route . '.index');
    }

    public function show()
    {

    }

    public function edit(NewsletterVideos $newsletter_video)
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        // Pass the resolved model as $row
        $data['row'] = $newsletter_video;
        $data['newsletter_video'] = NewsletterVideos::where('status', '1')->get();

        return view($this->view . '.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // Find the video record by ID
        $newsletterVideo = NewsletterVideos::findOrFail($id);

        // Validate the YouTube URL
        $request->validate([
            'youtube_video_id' => 'required|url',
        ]);

        // Get the YouTube video URL from the form input
        $youtubeUrl = $request->input('youtube_video_id');

        // Extract the YouTube video ID from the URL using a regex
        preg_match('/(?:https?:\/\/(?:www\.)?youtube\.com\/(?:[^\/\n\s]+\/\S+|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $youtubeUrl, $matches);

        // Check if the video ID is valid
        if (!isset($matches[1])) {
            Toastr::error(__('dashboard.invalid_video_link'), __('dashboard.error'));
            return redirect()->back();
        }

        // Get the extracted video ID
        $videoId = $matches[1];

        // Update the video record in the database
        $newsletterVideo->youtube_video_id = $videoId;
        $newsletterVideo->save();

        // Show a success message
        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        return redirect()->route($this->route . '.index');
    }

    public function destroy($id)
    {
        // Find the video record by ID
        $newsletterVideo = NewsletterVideos::findOrFail($id);

        // Delete the record from the database
        $newsletterVideo->delete();

        // Show a success message
        Toastr::success(__('dashboard.deleted_successfully'), __('dashboard.success'));

        return redirect()->route($this->route . '.index');
    }





}
