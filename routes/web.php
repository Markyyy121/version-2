<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;

Route::get('/', function () {
    return view('index');
});

Route::get('/user/landing', function () {
    return view('user.user_landing');
})->name('user.user_landing');

Route::get('/admin', function () {
    return view('admin.admin_login');
})->name('admin.admin_login');

Route::get('/user/register', [AuthController::class, 'showRegister'])->name('user.user_register');
Route::post('/user/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/user/login', [AuthController::class, 'showLogin'])->name('user.user_login');
Route::post('/user/login', [AuthController::class, 'login'])->name('login.store');

Route::get('/user/forgotpassword', [ForgotPasswordController::class, 'showForm'])->name('user.user_forgotpassword');
Route::post('user/forgotpassword', [ForgotPasswordController::class, 'sendOTP'])->name('user.sendotp');

Route::get('/user/otpcode', [ForgotPasswordController::class, 'showOtpForm'])->name('user.user_otpcode');
Route::post('/user/verify-otp', [ForgotPasswordController::class, 'verifyOTP'])->name('user.verifyotp');

Route::get('/user/newpassword', [ForgotPasswordController::class, 'showNewPasswordForm'])->name('user.user_newpassword');
Route::post('/user/newpassword', [ForgotPasswordController::class, 'resetPassword'])->name('user.resetpassword');

Route::get('/user/dashboard', function () {
    return view('user.user_dashboard');
})->name('user.user_dashboard');