<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\WebIndexController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('web.index');
// })->name('home');

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

/**
 * ROUTES WEB
 */
route::get('/',             [WebIndexController::class, 'index'])->name('web.home');
route::get('/download',     [WebIndexController::class, 'download'])->name('web.download');

route::get('active/{key}/{account}',     [WebIndexController::class, 'activeAccountView'])->name('web.active.index');
route::post('active/{account}/active',   [WebIndexController::class, 'activeAccount'])->name('web.active');

// CALLBACK MERCADO PAGO
Route::get('/callbackMessage', [WebIndexController::class, 'callback'])->name('callback');
