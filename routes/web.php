<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\Admin\CategoryController;
use App\Http\Controllers\Dashboard\Admin\ExperienceController;
use App\Http\Controllers\Dashboard\Admin\JobsController;
use App\Http\Controllers\Dashboard\Admin\PortofolioController;
use App\Http\Controllers\Dashboard\Admin\UserController;
use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Frontend\IndexController as FrontendIndexController;
use App\Http\Controllers\Frontend\JobsController as FrontendJobsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontendIndexController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [IndexController::class, 'index'])->name('dashboard');



    Route::middleware('isAdmin')->group(function () {
        // user
        Route::resource('users', UserController::class);
        Route::post('/deleteUser', [UserController::class, 'destroy'])->name('user-delete');

        // category
        Route::resource('category', CategoryController::class);
        Route::post('/deleteCategory', [CategoryController::class, 'destroy'])->name('category-delete');
    });

    // user profile
    Route::get('/userProfile', [UserController::class, 'getUser'])->name('userProfile');
    Route::put('userProfile/{id}', [UserController::class, 'updateProfile'])->name('updateProfile');

    // jobs
    Route::resource('jobs', JobsController::class);
    Route::post('/deleteJobs', [JobsController::class, 'destroy'])->name('jobs-delete');
    Route::post('updateStatus', [JobsController::class, 'updateStatus'])->name('jobs-status');

    // portofolio
    Route::resource('portofolio', PortofolioController::class);
    Route::delete('deleteImage/{id}', [PortofolioController::class, 'deleteImage'])->name('deleteImage');

    // experience
    Route::resource('experience', ExperienceController::class);
    Route::post('/deleteExperience', [ExperienceController::class, 'destroy'])->name('experience-delete');

    // add to Wishlist
    Route::get('/wishlist', [FrontendJobsController::class, 'wishlist'])->name('wishlist');
    Route::post('/wishlist/{id}', [FrontendJobsController::class, 'addWishlist'])->name('addWishlist');
    Route::post('/deleteWishlist', [FrontendJobsController::class, 'destroy'])->name('delete-wishlist');
});



// auth
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/loginAksi', [AuthController::class, 'login'])->name('loginAksi');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// register
Route::get('/registerClient', function () {
    return view('auth.register-client');
})->name('register-client');
Route::get('registerFreelance', function () {
    return view('auth.register-freelance');
})->name('register-freelance');
Route::post('/registerClient', [AuthController::class, 'registerClient'])->name('registerClient');
Route::post('/registerFreelance', [AuthController::class, 'registerFreelance'])->name('registerFreelance');


// Route frontend
// Jobs
Route::get('/loker', [FrontendJobsController::class, 'index'])->name('loker');
Route::get('/detailLoker/{id}', [FrontendJobsController::class, 'detail'])->name('detailLoker');
Route::get('/filterKategori/{id}', [FrontendJobsController::class, 'filterKategori'])->name('filter-kategori');
Route::get('filterJobs', [FrontendJobsController::class, 'filterJobs'])->name('filterJobs');

Route::get('/detailFreelance/{id}', [FrontendIndexController::class, 'detailFreelance'])->name('detailFreelance');
Route::get('/detailPorto/{id}', [FrontendIndexController::class, 'detailPortofolio'])->name('detailPorto');

Route::get('filterFreelance', [FrontendIndexController::class, 'filterFreelance'])->name('filter-freelance');
