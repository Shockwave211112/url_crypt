<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Models\Role;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/registration', [AuthController::class, 'registration']);

Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'emailVerify'])->name('verification.verify');

Route::post('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::group(['prefix' => 'user'],
        function () {
            Route::get('/info', [UserController::class, 'getInfo']);
            Route::group(
                ['middleware' => 'role:' . Role::ADMIN],
                function () {
                    Route::get('/', [UserController::class, 'index']);
                    Route::post('/', [UserController::class, 'store']);
                    Route::get('/{id}', [UserController::class, 'show']);
                    Route::put('/{id}', [UserController::class, 'update']);
                    Route::delete('/{id}', [UserController::class, 'delete']);
                });
        }
    );
});


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//        Route::group(
//            ['middleware' => ['auth:sanctum', 'role:' . Role::ADMIN]],
//            function () {
//                Route::get('/', [MetaController::class, 'index']);
//                Route::post('/', [MetaController::class, 'store']);
//                Route::get('/{id}', [MetaController::class, 'show']);
//                Route::put('/{id}', [MetaController::class, 'update']);
//                Route::delete('/{id}', [MetaController::class, 'destroy']);
//            }
