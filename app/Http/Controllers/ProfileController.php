<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showProfile()
    {
        $user_id = Auth::user()->id;

        $user = User::findOrFail($user_id);

        return view('profile', compact('user'));
    }

    public function updateProfile(Request $request, $user_id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $data = $request->all();

        $user = User::findOrFail($user_id);        

        $user->fill($data)->save();

        Session::flash('message', 'Your profile was updated successfully!');

        return redirect()->back();

    }
}
