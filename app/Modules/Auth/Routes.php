<?php

use App\Modules\Auth\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/registration', [AuthController::class, 'registration']);

Route::get('/email/verify', [AuthController::class, 'emailVerify'])->name('email.verify');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/email/resend', [AuthController::class, 'sendVerifyLink']);
    Route::get('/logout', [AuthController::class, 'logout']);
});
