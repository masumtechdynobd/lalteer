<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubscribeUser;
use Toastr;

class SubscribeUserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribe_users,email',
        ]);

        SubscribeUser::create([
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Thank you for subscribing!');
    }
}
