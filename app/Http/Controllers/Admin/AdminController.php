<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Admin login page view method
    public function loginView()
    {
        return view('admin.login');
    }

    //Cheak login authentication
    public function checkLogin(Request $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {

            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }

    //View admin dashboard method
    public function dashboard()
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

    //View all admin method
    public function allAdmins()
    {
        $allAdmins = Admin::latest()->get();
        return view('admin.allAdmins', compact('allAdmins'));
    }
}
