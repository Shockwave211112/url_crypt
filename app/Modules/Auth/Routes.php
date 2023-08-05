<?php

use App\Modules\Auth\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/registration', [AuthController::class, 'registration']);

Route::get('/email/verify', [AuthController::class, 'emailVerify'])->name('email.verify');

Route::get('/reset-password', [AuthController::class, 'getResetPassword'])->name('password.reset');
Route::post('/change-password', [AuthController::class, 'resetPassword']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/email/resend', [AuthController::class, 'sendVerifyLink']);
    Route::get('/logout', [AuthController::class, 'logout']);
});
