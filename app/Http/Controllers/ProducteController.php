<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producte;
use App\Models\Proveidor;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class ProducteController extends Controller
{
    public function index()
    {

        if (request('filtres-action') == 'reset') {
            echo "RESET";
        }

        //var_dump(request()->all());


        $proveidors = Proveidor::all()->pluck('nom')->toArray();
        $categories = Categoria::all()->pluck('nom')->toArray();

        $filtres_proveidors = request('filtres_proveidors') ?? $proveidors;
        $filtres_categories = request('filtres_categories') ?? $categories;
        $filtres_preuMaxim = request('preu-maxim') ?? 100;

        //MAYBE USE SESSION TO STORE FILTERS
        /*session(['filtres_proveidors' => $filtres_proveidors]);
        var_dump(session('filtres_proveidors'));*/

        $countProductes = count(Producte::all());
        $items = request('items') ?? 8;

        $productes = Producte::whereIn('proveidor', $filtres_proveidors)
                ->whereIn('categoria', $filtres_categories)
                ->where('preu', '<', $filtres_preuMaxim)
                ->paginate($items);


        return view('productes.productes', compact(
            'productes',
            'countProductes',
            'items',
            'proveidors',
            'filtres_proveidors',
            'categories',
            'filtres_categories',
            'filtres_preuMaxim'
        ));
    }

    public function show($id)
    {
        $producte = Producte::findOrFail($id);
        return view("productes.producte", compact('producte'));
    }
}
