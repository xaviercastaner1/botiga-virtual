<?php

namespace App\Http\Controllers;

use App\Models\Producte;
use App\Models\Proveidor;
use Illuminate\Http\Request;

class ProducteController extends Controller
{
    public function index()
    {

        $proveidors_filtres = request('proveidors_filtres');
        
        $countProductes = count(Producte::all());
        $items = request('items') ?? 8;

        $productes = Producte::where('proveidor', 'HUAWEI')->paginate($items);

        $proveidors = Proveidor::all()->pluck('nom');

        return view('productes.productes', compact(
            'productes',
            'countProductes',
            'items',
            'proveidors'
        ));
    }

    public function show($id)
    {
        $producte = Producte::findOrFail($id);
        return view("productes.producte", compact('producte'));
    }
}
