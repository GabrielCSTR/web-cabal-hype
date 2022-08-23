
<?php

use App\Http\Controllers\MercadoPagoController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=> 'web', 'Auth'], function(){

    Route::prefix('mercadopago')->group(function(){
        Route::post('/', [MercadoPagoController::class, 'getCreatePreference'])->name('mercadopago.index');
    });
});


