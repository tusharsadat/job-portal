<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\SaveJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $profile = User::find(Auth::user()->id);
        return view('users.profile', compact('profile'));
    }

    public function applications()
    {
        $applications = Application::where('user_id', Auth::user()->id)->paginate(5);
        return view('users.applications', compact('applications'));
    }

    public function savedJob()
    {
        $savedJobs = SaveJob::where('user_id', Auth::user()->id)->paginate(5);
        return view('users.savedJob', compact('savedJobs'));
    }

    public function editUser()
    {
        $editUser = User::find(Auth::user()->id);
        return view('users.editUser', compact('editUser'));
    }

    public function updateUser(Request $request)
    {

        $userdetailsUpdate = User::find(Auth::user()->id);
        $userdetailsUpdate->update([
            'name' => $request->name,
            'job_title' => $request->job_title,
            'user_bio' => $request->user_bio,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
        ]);

        if ($userdetailsUpdate) {
            return redirect()->route('profile')->with('success', 'Profile update successfully.');
        }
    }
}
