<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BotigaController;
use App\Http\Controllers\CheckoutController;

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
    return view('home');
});

/* ROUTES BOTIGA */
Route::get('/botiga', [BotigaController::class, "index"])->name("botiga");
Route::get('/producte/{id}', [BotigaController::class, "show"])->name("producte");

/* ROUTES CHECKOUT */
Route::get('/checkout', [CheckoutController::class, "index"])->name("checkout");

