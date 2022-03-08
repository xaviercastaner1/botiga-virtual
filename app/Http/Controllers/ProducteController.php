<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producte;
use App\Models\Proveidor;
use BladeUIKit\Components\Forms\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\VarDumper\VarDumper;
use Throwable;

class ProducteController extends Controller
{

    public function index(Request $request) {
        //Session::flush();

        Session::put('previous_productes_url', $request->fullUrl());

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

        return redirect()->route('producte.show', ['id' => $result->id]);

    }

    public function show($id) {
        $producte = Producte::findOrFail($id);
        $productes_url = '#';
        if (auth()->user()->admin) {
            $productes_url = Session::has('previous_admin_productes_url')
            ? Session::get('previous_admin_productes_url')
            : route('admin.producte.index');
        } else {
            $productes_url = Session::has('previous_productes_url')
            ? Session::get('previous_productes_url')
            : route('producte.index');
        }

        return view("productes.producte", compact(
            'producte',
            'productes_url'
        ));
    }

    public function edit($id) {
        $proveidors = Proveidor::all()->pluck('nom')->toArray();

        $categories = Categoria::all()->pluck('nom')->toArray();

        $producte = Producte::findOrFail($id);

        $productes_url = '#';
        if(auth()->user()->admin) {
            $productes_url = Session::has('previous_admin_productes_url')
            ? Session::get('previous_admin_productes_url')
            : route('admin.producte.index');
        } else {
            $productes_url = Session::has('previous_productes_url')
            ? Session::get('previous_productes_url')
            : route('producte.index');
        }

        return view("admin.productes.edit", compact(
            'producte',
            'proveidors',
            'categories',
            'productes_url'
        ));
    }

    public function update(Request $request, $id) {

        $result = Producte::where('id', $id)
            ->update([
                'nom' => $request->input('nom'),
                'descripcio' => $request->input('descripcio'),
                'imatge' => $request->input('imatge'),
                'preu' => $request->input('preu'),
                'descompte' => $request->input('descompte'),
                'stock' => $request->input('stock'),
                'proveidor' => $request->input('proveidor'),
                'categoria' => $request->input('categoria')
            ]);

        Session::put('return', [
            'msg' => $result ? 'Producte editat correctament.' : 'Error editant producte',
            'alert' => $result ? 'alert-success' : 'alert-warning'
        ]);

        return redirect()->route('producte.show', ['id' => $id]);


    }

    public function destroy($id) {
        $result = Producte::destroy($id);
        Session::put('return', [
            'msg' => $result ? 'Producte eliminat correctament.' : 'Error eliminant producte.',
            'alert' => $result ? 'alert-success' : 'alert-warning'
        ]);

        return Session::has('previous_admin_productes_url')
        ? redirect(Session::get('previous_admin_productes_url'))
        : redirect()->route('admin.producte.index');
    }


    public function admin(Request $request) {
        Session::put('previous_admin_productes_url', $request->fullUrl());

        $productes = Producte::paginate(20);
        $columnes = DB::getSchemaBuilder()->getColumnListing('productes');

        return view('admin.productes.index', compact(
            'productes',
            'columnes'
        ));
    }

}
