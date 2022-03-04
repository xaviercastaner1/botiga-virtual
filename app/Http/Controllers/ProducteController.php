<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producte;
use App\Models\Proveidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\VarDumper\VarDumper;
use Throwable;

class ProducteController extends Controller
{

    public function index() {
        //Session::flush();

        $proveidors = Proveidor::all()->pluck('nom')->toArray();

        $categories = array_map(
            function($val)
            { return ucwords($val); },
            Categoria::all()->pluck('nom')->toArray());


        $filtres_buscar = request('filtres_buscar') ?? '';

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
                ->where('nom', 'like', "%$filtres_buscar%")
                ->where('descripcio','like', "%$filtres_buscar%")
                ->where('preu', '<', $filtres_preu_maxim)
                ->where('stock', '>', 0)
                ->orderBy($filtres_ordenar, $ordenar_method)
                ->paginate($items);


        return view('productes.productes', compact(
            'productes',
            'countProductes',
            'items',
            'proveidors',
            'categories',
            'filtres_buscar',
            'filtres_proveidors',
            'filtres_categories',
            'filtres_preu_maxim',
            'filtres_ordenar',
            'ordenar_method',
            'columnes',
            'methods'
        ));
    }

    public function create() {
        $proveidors = Proveidor::all()->pluck('nom')->toArray();

        $categories = array_map(
            function ($val) {
                return ucwords($val);
            },
            Categoria::all()->pluck('nom')->toArray()
        );

        return view('admin.productes.create', compact('proveidors', 'categories'));
    }

    public function store(Request $request) {

        $result = Producte::create([
            'nom' => $request->input('nom') ?? 'Producte Default',
            'descripcio' => $request->input('descripcio') ?? 'Descripcio Producte Default',
            'imatge' => $request->input('imatge') ?? 'https://media.istockphoto.com/vectors/thumbnail-image-vector-graphic-vector-id1147544807?k=20&m=1147544807&s=612x612&w=0&h=pBhz1dkwsCMq37Udtp9sfxbjaMl27JUapoyYpQm0anc=',
            'preu' => $request->input('preu') ?? 30,
            'descompte' => $request->input('descompte') ?? 15,
            'stock' => $request->input('stock') ?? 50,
            'proveidor' => $request->input('proveidor') ?? 'HUAWEI',
            'categoria' => $request->input('categoria') ?? 'altaveus'
        ]);

        Session::put('return', [
            'msg' => $result ? 'Producte creat correctament.' : 'Error creant producte',
            'alert' => $result ? 'alert-success' : 'alert-warning'
        ]);

        return redirect()->route('producte.create');

    }

    public function show($id) {
        $producte = Producte::findOrFail($id);
        Session::put('previous_productes_url', url()->previous());
        return view("productes.producte", compact('producte'));
    }

    public function edit($id) {
        echo "edit $id";
    }

    public function update($id) {
        echo "update $id";
    }

    public function destroy($id) {
        echo "destroy $id";
    }

    public function updateStock() {

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

        if ($successFlag) {
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
