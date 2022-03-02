<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producte;
use App\Models\Proveidor;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\VarDumper\VarDumper;

class ProducteController extends Controller
{

    public function index() {
        //Session::flush();

        if(!Session::has('filtres')) {
            Session::put('filtres', []);
        }

        $proveidors = Proveidor::all()->pluck('nom')->toArray();
        $categories = Categoria::all()->pluck('nom')->toArray();

        VarDumper::dump(request()->all());

        $filtres_proveidors = request('filtres_proveidors') ?? $proveidors;
        Session::put("filtres.proveidors", $filtres_proveidors);

        $filtres_categories = request('filtres_categories') ?? $categories;
        Session::put("filtres.categories", $filtres_categories);

        $filtres_preuMaxim = request('preu-maxim') ?? 100;
        Session::put("filtres.preuMaxim", $filtres_preuMaxim);
        
        $filtres_ordenar = request('filtres_ordenar') ?? 'nom';
        Session::put("filtres.ordenar", $filtres_ordenar);

        $ordenar_method = request('ordenar_method') ?? 'ASC';
        Session::put("filtres.ordenar_method", $ordenar_method);

        $columnes = ['Nom', 'Preu', 'Descompte', 'Proveidor'];
        $methods = ["ASC" => "Ascendent", "DESC" => "Descendent"];

        $countProductes = count(Producte::all());
        $items = request('items') ?? 8;

        $productes = Producte::whereIn('proveidor', Session::get("filtres.proveidors") ?? $filtres_proveidors)
                ->whereIn('categoria', Session::get("filtres.categories") ?? $filtres_categories)
                ->where('preu', '<', Session::get("filtres.preuMaxim") ?? $filtres_preuMaxim)
                ->orderBy(
                    Session::get("filtres.ordenar") ?? $filtres_ordenar, 
                    Session::get("filtres.ordenar_method") ?? $ordenar_method
                )
                ->paginate($items);

        VarDumper::dump(Session::get('filtres'));


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
