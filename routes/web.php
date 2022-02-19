<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BotigaController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProducteController;
use App\Http\Controllers\CategoriaController;

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

/* ROUTES PRODUCTE */
Route::get('/producte/{id}', [ProducteController::class, "show"])->name("producte");

/* ROUTES CATEGORIA */
Route::get('/categories', [CategoriaController::class, "index"])->name("categories");
Route::get('/categories/{categoria}', [CategoriaController::class, "show"])->name("categoria");

/* ROUTES CHECKOUT */
Route::get('/checkout', [CheckoutController::class, "index"])->name("checkout");

