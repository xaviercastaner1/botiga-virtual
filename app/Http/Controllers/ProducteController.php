<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producte;
use App\Models\Proveidor;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\VarDumper\VarDumper;
use Throwable;

class ProducteController extends Controller
{

    public function index() {
        //Session::flush();

        $proveidors = Proveidor::all()->pluck('nom')->toArray();
        $categories = Categoria::all()->pluck('nom')->toArray();

        $filtres_proveidors = request('filtres_proveidors') ?? $proveidors;

        $filtres_categories = request('filtres_categories') ?? $categories;

        $filtres_preu_maxim = request('filtres_preu_maxim') ?? 100;

        $filtres_ordenar = request('filtres_ordenar') ?? 'nom';

        $ordenar_method = request('ordenar_method') ?? 'ASC';

        $columnes = ['Nom', 'Preu', 'Descompte', 'Proveidor'];
        $methods = ["ASC" => "Ascendent", "DESC" => "Descendent"];

        $countProductes = count(Producte::all());
        $items = request('items') ?? 8;

        $productes = Producte::whereIn('proveidor', $filtres_proveidors)
                ->whereIn('categoria', $filtres_categories)
                ->where('preu', '<', $filtres_preu_maxim)
                ->orderBy($filtres_ordenar, $ordenar_method)
                ->paginate($items);


        return view('productes.productes', compact(
            'productes',
            'countProductes',
            'items',
            'proveidors',
            'categories',
            'filtres_proveidors',
            'filtres_categories',
            'filtres_preu_maxim',
            'filtres_ordenar',
            'ordenar_method',
            'columnes',
            'methods'
        ));
    }

    public function show($id) {
        $producte = Producte::findOrFail($id);
        Session::put('previous_productes_url', url()->previous());
        return view("productes.producte", compact('producte'));
    }

    public function update() {

        $carret = Session::get('carret') ?? [];
        $successCount = 0;
        $successFlag = true;

        foreach ($carret as $id => $item) {

            try {

                $producte = Producte::findOrFail($id);
                $producte->stock -= $item[0]["unitats"];
                $producte->save();
                $successCount++;

            } catch (Throwable $e) {
                report($e);
                $successFlag = false;

            }
            
        }

        if($successFlag) {
            Session::forget('carret');
        }


        Session::put('return', [
            'msg' => "S'han comprat $successCount productes",
            'alert' => 'alert-success'
        ]);

        return Session::has('previous_productes_url')
        ? redirect(Session::get('previous_productes_url'))
        : redirect()->route('producte.index');
    }

}
