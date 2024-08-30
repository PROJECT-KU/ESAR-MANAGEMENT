<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Check if the username exists in the database
        $userExists = DB::table('users')->where('username', $credentials['username'])->exists();

        if (!$userExists) {
            // Username does not exist, return with SweetAlert error
            return redirect()->route('auth.admin')->with('errorbelumterdaftar', 'Account not found. Please register first.');
        }

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Authentication passed, redirect to Filament dashboard
            return redirect()->route('auth.view.dashboard');
        }

        // Authentication failed, return with SweetAlert error
        return redirect()->route('auth.admin')->with('errorakun', 'Incorrect username or password.');
    }



    public function logout(Request $request)
    {
        Auth::logout();

        // Redirect to the auth.admin route after logout
        return redirect()->route('auth.admin')->with('logout', 'You have been logged out successfully.');
    }
}
