<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\SaveJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function editCV()
    {
        $editCV = User::find(Auth::user()->id);
        return view('users.editCV', compact('editCV'));
    }

    public function updateCV(Request $request)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf,doc,docx|max:2048', // validate file type and size
        ]);

        $user = User::find(Auth::user()->id); // get user info user Auth facades

        // Handle the file upload
        if ($request->hasFile('cv')) {
            // Delete old CV if it exists
            if ($user->cv) {
                Storage::disk('public')->delete($user->cv); // remove the old file from storage
            }

            // Store the new file
            $path = $request->file('cv')->store('cvs', 'public'); // stores in the storage/app/cvs directory

            // Update user's CV path
            $user->cv = $path;
            $user->save();
        }

        if ($user) {
            return redirect()->route('profile')->with('success', 'CV update successfully.');
        }
    }
}
