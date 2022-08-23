<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=> 'web', 'Auth'], function(){

    Route::prefix('profile')->group(function(){

        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/update', [ProfileController::class, 'updatePW'])->name('profile.updatePW');

    });
});
