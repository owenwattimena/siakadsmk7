<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

Route::get('/mail', function () {
    return view('auth.mail-forgot-password');
});
Route::get('/', function () {
    return view('web.home');
});
Route::get('/post-list', function () {
    return view('web.post-list');
});
Route::get('/post', function () {
    return view('web.post');
});

Route::middleware(['guest'])->group(function () { 
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.login');
    Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'postEmail'])->name('forgot-password.postEmail');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset-password');
    
    Route::post('/reset-password/{token}', [ForgotPasswordController::class, 'updatePassword'])->name('reset-password.update');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/logout', function () {
        \Auth::logout();
        return redirect('/');
    })->name('logout');

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    Route::get('/dashboard/profile', [ProfileController::class, 'index'])->name('dashboard.profile');
    Route::put('/dashboard/profile', [ProfileController::class, 'updateProfile'])->name('dashboard.profile.put');
    Route::put('/dashboard/profile/change-password', [ProfileController::class, 'changePassword'])->name('dashboard.profile.password');
});