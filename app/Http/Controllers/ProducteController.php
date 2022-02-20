<?php

namespace App\Http\Controllers;

use App\Models\Producte;
use Illuminate\Http\Request;

class ProducteController extends Controller
{
    public function index()
    {
        $countProductes = count(Producte::all());
        $items = request('items') ?? 8;

        $productes = Producte::paginate($items);

        return view('productes.productes', compact(
            'productes',
            'countProductes',
            'items'
        ));
    }

    public function show($id)
    {
        $producte = Producte::findOrFail($id);
        return view("productes.producte", compact('producte'));
    }
}
