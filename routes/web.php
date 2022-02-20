<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BotigaController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProducteController;
use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Auth;

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

/* ROUTES PRODUCTE */
Route::get('/productes', [ProducteController::class, "index"])->name("producte.index");
Route::get('/productes/{id}', [ProducteController::class, "show"])->name("producte.show");

Route::post('/productes', [ProducteController::class, "index"])->name('productes.index');

/* ROUTES CATEGORIA */
Route::get('/categories', [CategoriaController::class, "index"])->name("categoria.index");
Route::get('/categories/{categoria}', [CategoriaController::class, "show"])->name("categoria.show");

/* ROUTES CHECKOUT */
Route::get('/checkout', [CheckoutController::class, "index"])->name("checkout");


Auth::routes(['register' => false]);
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
