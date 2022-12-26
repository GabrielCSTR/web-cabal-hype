<?php

use App\Http\Controllers\CharsController;
use App\Http\Middleware\isActive;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=> 'web', 'Auth'], function(){

    Route::middleware('checkIsActive')->group(function(){

        Route::prefix('chars')->group(function(){

            Route::get('/', [CharsController::class, 'index'])->name('chars.index');

            Route::post('/addPNT/{id}', [CharsController::class, 'addPoints'])->name('chars.addPNT');

            Route::post('/cleanPK/{id}', [CharsController::class, 'cleanPK'])->name('chars.cleanPK');

        });
    });
});
