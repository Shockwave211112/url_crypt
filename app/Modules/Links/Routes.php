<?php

use App\Modules\Links\Http\Controllers\GroupController;
use App\Modules\Links\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::get('/l/{referral}', [LinkController::class, 'referral'])->name('link.referral');

Route::group(['prefix' => 'links'],
    function () {
        Route::group(['middleware' => 'auth:sanctum'], function() {
            Route::get('/', [LinkController::class, 'index']);
            Route::post('/', [LinkController::class, 'store']);
            Route::get('/{id}', [LinkController::class, 'show']);
            Route::put('/{id}', [LinkController::class, 'update']);
            Route::delete('/{id}', [LinkController::class, 'delete']);
        });
    }
);

Route::group(['prefix' => 'groups'],
    function () {
        Route::group(['middleware' => 'auth:sanctum'], function() {
            Route::get('/', [GroupController::class, 'index']);
            Route::post('/', [GroupController::class, 'store']);
            Route::get('/{id}', [GroupController::class, 'show']);
            Route::put('/{id}', [GroupController::class, 'update']);
            Route::delete('/{id}', [GroupController::class, 'delete']);
        });
    }
);


