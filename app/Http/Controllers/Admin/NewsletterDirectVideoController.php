<?php

namespace App\Http\Controllers\Admin;

use Str;
use Toastr;
use Illuminate\Http\Request;
use App\Models\NewsletterVideos;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\NewsletterDirectVideo;
use Intervention\Image\Facades\Image;

class NewsletterDirectVideoController extends Controller
{
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('dashboard.blog', 1);
        $this->route = 'admin.newsletter_direct_video';
        $this->view = 'admin.newsletter_direct_video';
        $this->path = 'newsletter_direct_video';
    }

    public function index()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $data['rows'] = NewsletterDirectVideo::orderBy('id', 'desc')->get();


        return view($this->view . '.index', $data);
    }

    public function create()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;

        $data['newsletter_direct_videos'] = NewsletterDirectVideo::where('status', '1')->get();

        return view($this->view . '.create', $data);
    }

    public function store(Request $request)
    {
        // Validate the video input
        $request->validate([
            'video' => 'required|mimes:mp4,mov,avi,mkv,flv|max:20480', // Validation for video (max 20MB)
        ]);

        // Handle the file upload
        if ($request->hasFile('video')) {
            // Get the original filename and extension
            $filenameWithExt = $request->file('video')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('video')->getClientOriginalExtension();

            // Create a unique filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            // Create the upload directory if it doesn't exist
            $path = public_path('uploads/newsletter_videos/');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            // Move the uploaded video to the specified directory
            $videoPath = $path . $fileNameToStore;
            $request->file('video')->move($path, $fileNameToStore);

            // Optional: Save the video file path to the database
            $newsletterVideo = new NewsletterDirectVideo();
            $newsletterVideo->video = 'uploads/newsletter_videos/' . $fileNameToStore;
            $newsletterVideo->status = '1'; // Set status to active by default
            $newsletterVideo->save();

            // Display success message
            Toastr::success(__('dashboard.video uploaded successfully'), __('dashboard.success'));

            // Redirect to the index page
            return redirect()->route($this->route . '.index');
        } else {
            // If no video was uploaded, set a default response
            Toastr::error(__('dashboard.no_video_uploaded'), __('dashboard.error'));
            return redirect()->back();
        }
    }

    public function show(NewsletterDirectVideo $article, $id)
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

    public function edit(NewsletterDirectVideo $newsletter_photo, $id)
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        // Pass the resolved model as $row
        $data['row'] = $newsletter_photo->find($id);
        // $data['newsletter_direct_video'] = NewsletterDirectVideo::where('status', '1')->get();

        return view($this->view . '.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'video' => 'nullable|mimes:mp4,mkv,avi,webm,flv,mpg|max:10240', // Video validation (optional)
        ]);

        // Find the video record by ID
        $newsletterVideo = NewsletterDirectVideo::findOrFail($id);

        // Handle the video upload if a new file is provided
        if ($request->hasFile('video')) {
            // Get the original filename and extension
            $filenameWithExt = $request->file('video')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('video')->getClientOriginalExtension();

            // Create a unique filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            // Create the upload directory if it doesn't exist
            $path = public_path('uploads/newsletter_videos/');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            // Move the uploaded file to the desired directory
            $request->file('video')->move($path, $fileNameToStore);

            // If there's an existing video, delete it
            if ($newsletterVideo->video && file_exists(public_path($newsletterVideo->video))) {
                unlink(public_path($newsletterVideo->video));
            }

            // Update the video path in the database
            $newsletterVideo->video = 'uploads/newsletter_videos/' . $fileNameToStore;
        }

        // Update other fields if needed
        // For example, you might want to update the status or other information
        // $newsletterVideo->status = $request->input('status');

        // Save the updated record
        $newsletterVideo->save();

        // Display success message
        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        // Redirect back to the index page
        return redirect()->route($this->route . '.index');
    }

    public function destroy(NewsletterDirectVideo $article, $id)
    {

        $article->find($id)->delete();

        Toastr::success(__('dashboard.deleted_successfully'), __('dashboard.success'));

        return redirect()->back();
    }


}
