<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function loginView()
    {
        return view('admin.login');
    }

    public function checkLogin(Request $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {

            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }

    public function index()
    {
        return view('admin.index');
    }

    // Admin logout method
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();  // Logs out the admin

        // Optionally, invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to login or another page
        return redirect('/admin/login')->with('status', 'Admin logged out successfully!');
    }
}
