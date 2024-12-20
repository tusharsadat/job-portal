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

        //Admin route
        Route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
        Route::get('/admin/all-admins', 'allAdmins')->name('all.admins');
        Route::get('/admin/create-admin', 'createAdmin')->name('create.admin');
        Route::post('/admin/store-admin', 'storeAdmin')->name('store.admin');

        //Category route
        Route::get('/admin/all-category', 'allCategory')->name('all.category');
        Route::get('/admin/create-category', 'createCategory')->name('create.category');
        Route::post('/admin/store-category', 'storeCategory')->name('store.category');
        Route::get('/admin/edit-category/{id}', 'editCategory')->name('edit.category');
        Route::post('/admin/update-category', 'updateCategory')->name('update.category');
        Route::get('/admin/delete-category/{id}', 'deleteCategory')->name('delete.category');

        //Job route
        Route::get('/admin/all-job', 'allJob')->name('all.job');
        Route::get('/admin/create-job', 'createJob')->name('create.job');
        //Use POST for creating new records.
        Route::post('/admin/store-job', 'storeJob')->name('store.job');
        Route::get('/admin/edit-job/{id}', 'editJob')->name('edit.job');
        //Route::post('/admin/update-job', 'updateJob')->name('update.job');

        //Use PUT (or PATCH for partial updates) to update existing records.
        Route::put('/admin/update-job/{id}', 'updateJob')->name('update.job');
        Route::delete('/admin/delete-job/{id}', 'deleteJob')->name('delete.job');

        //Application route
        Route::get('/admin/all-application', 'allApplication')->name('all.application');
        Route::delete('/admin/delete-application/{id}', 'deleteApplication')->name('delete.application');
    });
});
