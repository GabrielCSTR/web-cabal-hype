<?php

use App\Http\Controllers\DonateController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=> 'web', 'Auth'], function(){

    Route::middleware('checkIsActive')->group(function(){

        Route::prefix('donate')->group(function(){

            Route::get('/', [DonateController::class, 'index'])->name('donate.index');
        });
    });
});
