<?php


use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=> 'web', 'Auth', 'isActive'], function(){

    Route::middleware('checkIsActive')->group(function(){

        Route::prefix('shop')->group(function(){

            Route::get('/cart', [ShopController::class, 'cart'])->name('cart.index');

            Route::get('/{id}', [ShopController::class, 'index'])->name('shop.index');

            Route::get('add-to-cart/{id}', [ShopController::class, 'addToCart'])->name('add.to.cart');

            Route::patch('update-cart', [ShopController::class, 'update'])->name('update.cart');

            Route::delete('remove-from-cart', [ShopController::class, 'remove'])->name('remove.from.cart');

            Route::post('buy-product', [ShopController::class, 'buyProduct'])->name('buy.product');
        });
    });
});