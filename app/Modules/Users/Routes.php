<?php

use App\Modules\Users\Http\Controllers\UserController;
use App\Modules\Users\Models\Role;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:sanctum'], function() {
    //USER
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
