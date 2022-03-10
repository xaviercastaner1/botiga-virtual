<?php

namespace App\Http\Controllers;

use App\Models\Proveidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProveidorController extends Controller
{
    public function index(Request $request)
    {

        $proveidors = Proveidor::all();

        return view('admin.proveidors.index', compact(
            'proveidors'
        ));
    }

    public function store(Request $request)
    {

        $proveidor = new Proveidor();
        $proveidor->nom = $request->input('nom') ?? 'Proveidor Default';
        $result = $proveidor->save();

        Session::put('return', [
            'msg' => $result ? 'Proveidor creat correctament.' : 'Error creant proveidor.',
            'alert' => $result ? 'alert-success' : 'alert-warning'
        ]);

        return redirect()->route('proveidor.index');
    }

    public function update(Request $request, $nom)
    {

        $result = Proveidor::where('nom', $nom)
            ->update([
                'nom' => $request->input('nom')
            ]);

        Session::put('return', [
            'msg' => $result ? 'Proveidor editat correctament.' : 'Error editant proveidor',
            'alert' => $result ? 'alert-success' : 'alert-warning'
        ]);

        return redirect()->route('proveidor.index');
    }

    public function destroy($nom)
    {
        $result = Proveidor::where('nom', '=', $nom)->delete();

        Session::put('return', [
            'msg' => $result ? 'Proveidor eliminada correctament.' : 'Error eliminant proveidor.',
            'alert' => $result ? 'alert-success' : 'alert-warning'
        ]);

        return redirect()->route('proveidor.index');
    }
}
