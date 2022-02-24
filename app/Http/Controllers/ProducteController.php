<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producte;
use App\Models\Proveidor;
use Illuminate\Http\Client\Request;

class ProducteController extends Controller
{

    public function index() {


        $proveidors = Proveidor::all()->pluck('nom')->toArray();
        $categories = Categoria::all()->pluck('nom')->toArray();

        $filtres_proveidors = request('filtres_proveidors') ?? $proveidors;
        $filtres_categories = request('filtres_categories') ?? $categories;
        $filtres_preuMaxim = request('preu-maxim') ?? 100;
        $filtres_ordenar = request('filtres_ordenar') ?? 'nom';
        $ordenar_method = request('ordenar_method') ?? 'ASC';

        $columnes = ['Nom', 'Preu', 'Descompte', 'Proveidor'];
        $methods = ["ASC" => "Ascendent", "DESC" => "Descendent"];

        $countProductes = count(Producte::all());
        $items = request('items') ?? 8;

        $productes = Producte::whereIn('proveidor', $filtres_proveidors)
                ->whereIn('categoria', $filtres_categories)
                ->where('preu', '<', $filtres_preuMaxim)
                ->orderBy($filtres_ordenar, $ordenar_method)
                ->paginate($items);


        return view('productes.productes', compact(
            'productes',
            'countProductes',
            'items',
            'proveidors',
            'filtres_proveidors',
            'categories',
            'filtres_categories',
            'filtres_preuMaxim',
            'columnes',
            'methods'
        ));
    }

    public function show($id) {   
        $producte = Producte::findOrFail($id);
        return view("productes.producte", compact('producte'));
    }

}
