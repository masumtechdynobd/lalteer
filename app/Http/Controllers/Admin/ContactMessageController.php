<?php

namespace App\Http\Controllers\Admin;

use Str;
use Toastr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\ContactMessageSubject;


class ContactMessageController extends Controller
{
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('dashboard.blog', 1);
        $this->route = 'admin.contact_message';
        $this->view = 'admin.contact_message';
        $this->path = 'contact_message';
    }

    public function index()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $data['rows'] = ContactMessageSubject::orderBy('id', 'desc')->get();

        return view($this->view . '.index', $data);
    }

    public function create()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;

        // $data['newsletter_videos'] = NewsletterVideos::where('status', '1')->get();

        return view($this->view . '.create', $data);
    }

    public function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'subject_name' => 'required|string|max:255|unique:contact_message_subjects,subject_name',
        ]);

        // Create a new subject
        $subject = new ContactMessageSubject();
        $subject->subject_name = $request->input('subject_name');
        $subject->save();

        // Show success message
        Toastr::success(__('dashboard.created_successfully'), __('dashboard.success'));

        // Redirect to the index page
        return redirect()->route($this->route . '.index');
    }

    public function show(ContactMessageSubject $article, $id)
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

    public function edit(ContactMessageSubject $contact_message_subject, $id)
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        // Pass the resolved model as $row
        $data['row'] = $contact_message_subject->find($id);

        return view($this->view . '.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // Find the subject by its ID
        $subject = ContactMessageSubject::findOrFail($id);

        // Validate the form input
        $request->validate([
            'subject_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('contact_message_subjects', 'subject_name')->ignore($id),
            ],
        ]);

        // Update the subject
        $subject->subject_name = $request->input('subject_name');
        $subject->save();

        // Show success message
        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        // Redirect to the index page
        return redirect()->route($this->route . '.index');
    }


    public function destroy($id)
    {
        // Find the video record by ID
        $newsletterVideo = ContactMessageSubject::findOrFail($id);

        // Delete the record from the database
        $newsletterVideo->delete();

        // Show a success message
        Toastr::success(__('dashboard.deleted_successfully'), __('dashboard.success'));

        return redirect()->route($this->route . '.index');
    }





}
