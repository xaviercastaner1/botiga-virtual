<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContacteController;
use App\Http\Controllers\ProducteController;
use App\Http\Controllers\CarretController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\UserController;
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



/* ROUTES CONTACTE */
Route::get('/contacte', [ContacteController::class, "index"])->name("contacte.index");



/* ROUTES PRODUCTE */
Route::post('/productes', [ProducteController::class, "index"])->name('productes.index');
Route::get('/productes', [ProducteController::class, "index"])->name("producte.index");

Route::get('/productes/create', [ProducteController::class, "create"])->name("producte.create")
->middleware('userIsAdmin');

Route::post('/productes/store', [ProducteController::class, "store"])->name("producte.store")
->middleware('userIsAdmin');

Route::get('/productes/{id}', [ProducteController::class, "show"])->name("producte.show");

Route::get('/productes/{id}/edit', [ProducteController::class, "edit"])->name("producte.edit")
->middleware('userIsAdmin');

Route::post('/productes/update/{id}', [ProducteController::class, "update"])->name("producte.update")
->middleware('userIsAdmin');

Route::post('/productes/destroy/{id}', [ProducteController::class, "destroy"])->name("producte.destroy")
->middleware('userIsAdmin');

Route::post('/productes/updateStock', [ProducteController::class, "updateStock"])->name("producte.updateStock");



/* ROUTES CARRET */
Route::get('/carret', [CarretController::class, "index"])->name("carret.index")
->middleware('userIsLogged');

Route::get('/carret/{id}', [CarretController::class, "show"])->name("carret.show")
->middleware('userIsLogged');

Route::post('/carret/{id}', [CarretController::class, "store"])->name("carret.store")
->middleware('userIsLogged');

Route::post('/carret/destroy/{id}', [CarretController::class, "destroy"])->name("carret.destroy")
->middleware('userIsLogged');



/* ROUTES USER */
Route::get('/user/{id}', [UserController::class, "show"])->name("user.show")
->middleware('userIsLogged');

Route::post('/user/{id}', [UserController::class, "update"])->name("user.update")
->middleware('userIsLogged');



Auth::routes();



//OBSOLETE ROUTES
Route::get('/cookie/set', [CookieController::class, "setCookie"]);
Route::get('/cookie/get', [CookieController::class, "getCookie"]);
