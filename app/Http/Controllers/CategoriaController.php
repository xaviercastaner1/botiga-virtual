<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Proveidor;
use BladeUIKit\Components\Forms\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\VarDumper\VarDumper;
use Throwable;

class CategoriaController extends Controller
{

    public function index(Request $request) {

        $categories = Categoria::all();

        return view('admin.categories.index', compact(
            'categories'
        ));
    }

    public function store(Request $request) {

        $categoria = new Categoria();
        $categoria->nom = $request->input('nom') ?? 'Categoria Default';
        $result = $categoria->save();

        Session::put('return', [
            'msg' => $result ? 'Categoria creada correctament.' : 'Error creant categoria.',
            'alert' => $result ? 'alert-success' : 'alert-warning'
        ]);

        return redirect()->route('categoria.index');
    }

    public function update(Request $request, $nom) {

        $result = Categoria::where('nom', $nom)
            ->update([
                'nom' => $request->input('nom')
            ]);

        Session::put('return', [
            'msg' => $result ? 'Categoria editat correctament.' : 'Error editant categoria',
            'alert' => $result ? 'alert-success' : 'alert-warning'
        ]);

        return redirect()->route('categoria.index');
    }

    public function destroy($nom) {
        $result = Categoria::where('nom', '=', $nom)->delete();

        Session::put('return', [
            'msg' => $result ? 'Categoria eliminada correctament.' : 'Error eliminant categoria.',
            'alert' => $result ? 'alert-success' : 'alert-warning'
        ]);

        return redirect()->route('categoria.index');
    }

}
