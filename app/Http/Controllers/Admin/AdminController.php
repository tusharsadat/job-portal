<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Application;
use App\Models\Category;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $jobCount = Job::count();
        $categoryCount = Category::count();
        $adminCount = Admin::count();
        $applicationCount = Application::count();
        return view('admin.index', compact('jobCount', 'categoryCount', 'adminCount', 'applicationCount'));
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
        $allAdmins = Admin::get();
        return view('admin.allAdmins', compact('allAdmins'));
    }

    //Create new admin
    public function createAdmin()
    {
        return view('admin.create');
    }
    //Store admin data
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->route('all.admins')->with('success', 'Product created successfully.');
    }
}
