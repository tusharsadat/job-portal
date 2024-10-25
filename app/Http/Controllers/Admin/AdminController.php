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
use Illuminate\Support\Facades\Storage;

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
        return redirect()->route('all.admins')->with('success', 'Admin created successfully.');
    }

    //Display all category
    public function allCategory()
    {
        $allCategory = Category::paginate(10);
        return view('admin.allCategory', compact('allCategory'));
    }
    //Create new category
    public function createCategory()
    {
        return view('admin.createCategory');
    }
    //Store category data
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories'],
        ]);
        Category::create([
            'name' => $request->name,
        ]);
        return redirect()->route('all.category')->with('success', 'Category created successfully.');
    }

    public function editCategory($id)
    {
        $categoryinfo = Category::findOrFail($id);
        return view('admin.editcategory', compact('categoryinfo'));
    }

    public function updateCategory(Request $request)
    {
        $category_id = $request->category_id;
        //dd($request->all());

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories'],
        ]);

        Category::findOrFail($category_id)->update([
            'name' => $request['name'],
        ]);

        return redirect()->route('all.category')->with('success', 'Category update successfully');
    }
    //delete method
    public function deleteCategory($id)
    {
        Category::findOrFail($id)->delete();

        return redirect()->route('all.category')->with('success', 'Category delete successfully');
    }

    //Display all job
    public function allJob()
    {
        // Query to get jobs along with their categories, paginated 10 per page
        $allJobs = Job::with('category') // Eager load the category to avoid N+1 problem
            ->paginate(10);    // Paginate results, 10 jobs per page
        return view('admin.allJob', compact('allJobs'));
    }
    //Create new job
    public function createJob()
    {
        $categories = Category::latest()->get();
        return view('admin.createJob', compact('categories'));
    }
    //Store category data
    public function storeJob(Request $request)
    {
        // Validate the fields
        $request->validate([
            'job_title' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'job_type' => 'required',
            'vacancy' => 'required',
            'experience' => 'required',
            'salary' => 'required',
            'gender' => 'required',
            'application_deadline' => 'required',
            'job_des' => 'required',
            'responsibilities' => 'required',
            'education_experience' => 'required',
            'other_benifits' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'image' =>  'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Image is optional
        ]);

        // Prepare the data for storing
        $data = [
            'job_title' => $request->job_title,
            'region' => $request->region,
            'company_name' => $request->company_name,
            'job_type' => $request->job_type,
            'vacancy' => $request->vacancy,
            'experience' => $request->experience,
            'salary' => $request->salary,
            'gender' => $request->gender,
            'application_deadline' => $request->application_deadline,
            'job_des' => $request->job_des,
            'responsibilities' => $request->responsibilities,
            'education_experience' => $request->education_experience,
            'other_benifits' => $request->other_benifits,
            'category_id' => $request->category_id,

        ];

        // If an image is uploaded, store it
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public'); // stores in the storage/app/images directory
            $data['image'] = $path;
        }
        // Save the data (with or without the image)
        Job::create($data);

        return redirect()->route('all.job')->with('success', 'Job created successfully.');
    }
    public function editJob($id)
    {
        $job = Job::findOrFail($id);
        $categories = Category::all(); // Fetch all categories for the select dropdown
        return view('admin.editjob', compact('job', 'categories'));
    }
    public function updateJob(Request $request, $id)
    {
        // Validate the fields
        $request->validate([
            'job_title' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'job_type' => 'required',
            'vacancy' => 'required',
            'experience' => 'required',
            'salary' => 'required',
            'gender' => 'required',
            'application_deadline' => 'required',
            'job_des' => 'required',
            'responsibilities' => 'required',
            'education_experience' => 'required',
            'other_benifits' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);

        // Using save() method and get id from route parametar

        $job = Job::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if necessary
            if ($job->image) {
                Storage::delete('public/' . $job->image);
            }
            // Store the new image
            $path = $request->file('image')->store('images', 'public');
            $job->image = $path;
        }

        // Update other fields
        $job->job_title = $request->job_title;
        $job->region = $request->region;
        $job->company_name = $request->company_name;
        $job->job_type = $request->job_type;
        $job->vacancy = $request->vacancy;
        $job->experience = $request->experience;
        $job->salary = $request->salary;
        $job->gender = $request->gender;
        $job->application_deadline = $request->application_deadline;
        $job->job_des = $request->job_des;
        $job->responsibilities = $request->responsibilities;
        $job->education_experience = $request->education_experience;
        $job->other_benifits = $request->other_benifits;
        $job->category_id = $request->category_id;

        $job->save();

        // Using Update() method and get job_id from hidden input field

        //   $job_id = $request->job_id;
        // $job = Job::findOrFail($job_id);

        // // Handle image upload
        // if ($request->hasFile('image')) {
        //     // Delete the old image if necessary
        //     if ($job->image) {
        //         Storage::delete('public/' . $job->image);
        //     }
        //     // Store the new image
        //     $path = $request->file('image')->store('images', 'public');
        //     $job['image'] = $path;
        // }

        // // Update other fields

        // $job = [
        //     'job_title' => $request->job_title,
        //     'region' => $request->region,
        //     'company_name' => $request->company_name,
        //     'job_type' => $request->job_type,
        //     'vacancy' => $request->vacancy,
        //     'experience' => $request->experience,
        //     'salary' => $request->salary,
        //     'gender' => $request->gender,
        //     'application_deadline' => $request->application_deadline,
        //     'job_des' => $request->job_des,
        //     'responsibilities' => $request->responsibilities,
        //     'education_experience' => $request->education_experience,
        //     'other_benifits' => $request->other_benifits,
        //     'category_id' => $request->category_id,

        // ];

        // Job::findOrFail($job_id)->update($job);

        return redirect()->route('all.job')->with('success', 'Job updated successfully!');
    }

    public function deleteJob($id)
    {
        // Find the job by its ID
        $job = Job::findOrFail($id);

        // Check if the job has an associated image
        if ($job->image) {
            // Delete the image from storage
            Storage::delete('public/' . $job->image);
        }

        // Delete the job from the database
        $job->delete();

        // Redirect back with a success message
        return redirect()->route('all.job')->with('success', 'Job and associated image deleted successfully!');
    }
    //Display all category
    public function allApplication()
    {
        $allApplication = Application::paginate(10);
        return view('admin.allApplication', compact('allApplication'));
    }
    //delete method
    public function deleteApplication($id)
    {
        Application::findOrFail($id)->delete();

        return redirect()->route('all.application')->with('success', 'Job Application delete successfully');
    }
}
