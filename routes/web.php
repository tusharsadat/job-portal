<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/admin', function () {
//     return view('layouts.admin.admin');
// });

Auth::routes();

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    //Route::get('/home', 'index')->name('home'); // Add this line to handle `/home`
    Route::post('/jobs/search', 'searchJobs')->name('jobs.search');
});

Route::controller(JobController::class)->group(function () {
    Route::get('/jobs/singleJob/{id}', 'index')->name('single-job');
    Route::post('/jobs/saveJob', 'singleJobSave')->name('save.job');
    Route::post('/jobs/applyJob', 'applyJob')->name('apply.job');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories/singleCategory/{id}/{name}', 'getJobsByCategory')->name('single.category');
});
Route::middleware('auth')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/users/profile', 'profile')->name('profile');
        Route::get('/users/applications', 'applications')->name('applications');
        Route::get('/users/savedJob',  'savedJob')->name('saved.job');
        Route::get('/users/editUser',  'editUser')->name('edit.user');
        Route::post('/users/updateUser',  'updateUser')->name('update.user');
        Route::get('/users/editCV', 'editCV')->name('edit.CV');
        Route::post('/users/updateCV',  'updateCV')->name('update.CV');
    });
});



Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/login', 'loginView')->name('admin.login')->middleware('CheckForAuth');
    Route::post('/admin/login', 'checkLogin')->name('check.login');
    Route::post('/admin/logout', 'logout')->name('admin.logout');
});

Route::middleware('auth:admin')->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/dashboard', 'index')->name('admin.dashboard');
    });
});
