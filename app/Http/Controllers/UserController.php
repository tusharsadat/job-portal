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
}
