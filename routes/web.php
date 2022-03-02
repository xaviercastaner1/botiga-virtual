<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContacteController;
use App\Http\Controllers\ProducteController;
use App\Http\Controllers\CarretController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CookieController;
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
})->name('home');

Route::get('/home', function () {
    return view('home');
})->name('home');

/* ROUTES CONTACTE */
Route::get('/contacte', [ContacteController::class, "index"])->name("contacte.index");

/* ROUTES PRODUCTE */
Route::get('/productes', [ProducteController::class, "index"])->name("producte.index");
Route::get('/productes/{id}', [ProducteController::class, "show"])->name("producte.show");

Route::post('/productes', [ProducteController::class, "index"])->name('productes.index');

/* ROUTES CARRET */
Route::get('/carret', [CarretController::class, "index"])->name("carret.index")
->middleware('userIsLogged');
Route::get('/carret/{id}', [CarretController::class, "show"])->name("carret.show")
->middleware('userIsLogged');
Route::post('/carret/{id}', [CarretController::class, "store"])->name("carret.store")
->middleware('userIsLogged');
Route::post('/carret/destroy/{id}', [CarretController::class, "destroy"])->name("carret.destroy")
->middleware('userIsLogged');

Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/cookie/set', [CookieController::class, "setCookie"]);
Route::get('/cookie/get', [CookieController::class, "getCookie"]);
