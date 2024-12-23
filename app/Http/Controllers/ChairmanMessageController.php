<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChairmanMessage;
use Illuminate\Support\Facades\File;


class ChairmanMessageController extends Controller
{
    //
    public function index()
    {
        $chairmanMessage = ChairmanMessage::first();
        return view('admin.chairman_message.index', compact('chairmanMessage'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $chairmanMessage = ChairmanMessage::first(); // Assuming only one message exists.

        if ($chairmanMessage) {
            $chairmanMessage->title = $request->title;
            $chairmanMessage->designation = $request->designation;
            $chairmanMessage->description = $request->description;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $folderPath = public_path('uploads/chairman_message');

                if (!File::exists($folderPath)) {
                    File::makeDirectory($folderPath, 0777, true);
                }
                $image->move($folderPath, $imageName);
                $chairmanMessage->image_path = $imageName;
            }


            $chairmanMessage->save();

            return redirect()->route('admin.chairman_message.index')->with('success', 'Chairman Message updated successfully!');
        }

        return redirect()->route('admin.chairman_message.index')->with('error', 'Chairman Message not found!');
    }
}
