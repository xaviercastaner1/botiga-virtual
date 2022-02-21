<?php

namespace App\Http\Controllers;

use App\Models\Producte;
use App\Models\Proveidor;
use Illuminate\Http\Request;

class ProducteController extends Controller
{
    public function index()
    {

        $proveidors = Proveidor::all()->pluck('nom')->toArray();

        

        $proveidors_filtres = request('proveidors_filtres') ?? $proveidors;
        
        $countProductes = count(Producte::all());
        $items = request('items') ?? 8;

        $productes = Producte::whereIn('proveidor', $proveidors_filtres)->paginate($items);


        return view('productes.productes', compact(
            'productes',
            'countProductes',
            'items',
            'proveidors',
            'proveidors_filtres'
        ));
    }

    public function show($id)
    {
        $producte = Producte::findOrFail($id);
        return view("productes.producte", compact('producte'));
    }
}
