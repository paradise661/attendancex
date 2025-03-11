<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Hash;

class Authcontroller extends Controller
{
    public function showLoginForm()
    {
        dd("this is test123");
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->roles->isEmpty()) {
                Auth::logout();
                return redirect("login")->withError('You are not authorized to access this system.');
            }

            return redirect()->intended('dashboard')
                ->withSuccess('You have Successfully logged In');
        }

        return redirect("login")->withError('Oppes! You have entered invalid credentials');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }

    public function changePassword()
    {
        return view('auth.profile');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        // Check if the current password matches the authenticated user's password
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the password
        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);


        // Redirect with a success message
        return redirect()->back()->with('message', 'Password changed successfully.');
    }
}
