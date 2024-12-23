<?php

namespace App\Http\Controllers\Admin;

use Toastr;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Http\Controllers\Controller;

class ContactMessageUserController extends Controller
{
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('dashboard.blog', 1);
        $this->route = 'admin.contact_message_user';
        $this->view = 'admin.contact_message_user';
        $this->path = 'contact_message_user';
    }

    public function index()
    {
        // Define data for view
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        // Fetch all contact messages with the related subject information
        $data['rows'] = ContactMessage::with('subject')->orderBy('id', 'desc')->get();

        // Return the view with the data
        return view($this->view . '.index', $data);
    }

    public function destroy($id)
    {
        try {
            // Find the message by ID
            $message = ContactMessage::findOrFail($id);

            // Delete the message
            $message->delete();

            // Show success message
            Toastr::success(__('dashboard.deleted_successfully'), __('dashboard.success'));

            // Redirect back to the index page
            return redirect()->route($this->route . '.index');
        } catch (\Exception $e) {
            // Handle any errors during deletion
            Toastr::error(__('dashboard.something_went_wrong'), __('dashboard.error'));
            return redirect()->back();
        }
    }


}
