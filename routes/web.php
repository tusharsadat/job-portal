<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Route::controller(JobController::class)->group(function () {
    Route::get('/jobs/singleJob/{id}', 'index')->name('single-job');
    Route::post('/jobs/saveJob', 'singleJobSave')->name('save.job');
    Route::post('/jobs/applyJob', 'applyJob')->name('apply.job');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories/singleCategory/{id}/{name}', 'getJobsByCategory')->name('single.category');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users/profile', 'profile')->name('profile');
    Route::get('/users/applications', 'applications')->name('applications');
    Route::get('/users/savedJob',  'savedJob')->name('saved.job');
    Route::get('/users/editUser',  'editUser')->name('edit.user');
    Route::post('/users/updateUser',  'updateUser')->name('update.user');
    Route::get('/users/editCV', 'editCV')->name('edit.CV');
    Route::post('/users/updateCV',  'updateCV')->name('update.CV');
});
