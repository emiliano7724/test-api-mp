<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhooksController;
use App\Http\Controllers\PagoController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::post('webhooks', WebhooksController::class)->name('webhooks');
Route::get('success/pay', [PagoController::class,'successPayMP'])->name('returnPagoExitosoMP');
Route::get('preparar/pago', [PagoController::class,'prepararPago'])->name('prepararPago');