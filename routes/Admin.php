<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::prefix('admin')->group(function(){

        /**
         * SHOP Categorias
         */
        Route::get('category', [AdminController::class, 'indexCategory'])->name('shop.index-category.view');

        Route::post('add-category', [AdminController::class, 'addCategory'])->name('shop.add-category');

        Route::post('delete-category', [AdminController::class, 'deleteCategory'])->name('shop.delete-category');

        /**
         * SHOP Items
         */

        Route::get('items', [AdminController::class, 'indexItems'])->name('shop.index-items.view');

        Route::post('add-item', [AdminController::class, 'addItem'])->name('shop.add-items');

        Route::post('delete-item', [AdminController::class, 'deleteItem'])->name('shop.delete-item');

        /**
         * SHOP TRANSATIONS
         */
        Route::get('transations-logs', [AdminController::class, 'indexTransations'])->name('shop.transations.view');

        /**
         * DONATE PLANOS
         */
        Route::get('donate-plans', [AdminController::class, 'donatePlans'])->name('donate.plans.view');
        Route::post('donate-plans', [AdminController::class, 'donatePlanStore'])->name('donate.plans.store');
        Route::delete('plan-delete/{id}', [AdminController::class, 'donatePlanDestroy'])->name('donate.plans.destroy');

    });
});
