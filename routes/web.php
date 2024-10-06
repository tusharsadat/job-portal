<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/jobs/singleJob/{id}', [JobController::class, 'index'])->name('single-job');

Route::post('/jobs/saveJob', [JobController::class, 'singleJobSave'])->name('save.job');

Route::post('/jobs/applyJob', [JobController::class, 'applyJob'])->name('apply.job');

Route::get('/categories/singleCategory/{id}/{name}', [CategoryController::class, 'getJobsByCategory'])->name('single.category');

Route::get('/users/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/users/applications', [UserController::class, 'applications'])->name('applications');
