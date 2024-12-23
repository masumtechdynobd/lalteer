<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Toastr;

class HomeContactController extends Controller
{
    public function html_email(Request $request)
    {

        $to_email = Setting::first();

        $sitename = $to_email->title;
        $email = $to_email->email_one;
        //fetch data from user email
        $from_email = $request->email;
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message_content' => $request->message // Avoid using 'message' as it's a reserved variable in Blade
        ];
        Mail::send('homeContactmail', $data, function ($message) use ($sitename, $email, $from_email) {
            $message->to($email, $sitename)->subject('Lalteer Email');
            $message->from($from_email, $sitename);
        });

        Toastr::success('Mail Sent Successfully', 'success');
        return back();
    }
}