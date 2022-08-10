<?php

use App\Http\Controllers\AuthController;
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

/**
 * ROUTES WEB
 */
route::get('/', [WebIndexController::class, 'index'])->name('web.home');
route::get('/download', [WebIndexController::class, 'download'])->name('web.download');
route::post('/register', [AuthController::class, 'register'])->name('web.register');
