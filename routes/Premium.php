<?php

use App\Http\Controllers\PremiumController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=> 'web', 'Auth'], function(){

    Route::prefix('premium')->group(function(){

        Route::get('/', [PremiumController::class, 'index'])->name('premium.index');
        Route::post('/buy-vip', [PremiumController::class, 'buyVip'])->name('premium.buyvip');
    });
});
