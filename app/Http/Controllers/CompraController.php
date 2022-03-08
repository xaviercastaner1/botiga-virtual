<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producte;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\VarDumper\VarDumper;

class CompraController extends Controller
{
    public function index() {
        $compres = Compra::where('id_user', '=', Auth::id())->paginate(20) ?? [];

        $compresArr = [];

        foreach ($compres as $compra) {

            foreach(json_decode($compra->productes) as $id_producte => $item) {
                $producte = Producte::findOrFail($id_producte);

            }

        }

        return view("compres.index", compact(
            'compres'
        ));
    }

    public function store() {
        $carret = Session::get('carret') ?? [];
        $successCount = 0;

        $date = new DateTime();

        $compra = new Compra();
        $compra->id_user = Auth::id();
        $compra->productes = json_encode($carret);
        $compra->data_compra = $date;
        $compra->data_entrega = NULL;
        $result = $compra->save();



        if ($result) {

            foreach ($carret as $id => $item) {

                $producte = Producte::findOrFail($id);
                $producte->stock -= $item[0]["unitats"];

                if($producte->save()) {

                    $successCount++;
                    Session::forget("carret.$id");

                }

            }

        }


        Session::put('return', [
            'msg' => "S'han comprat $successCount productes",
            'alert' => 'alert-success'
        ]);

        return Session::has('previous_productes_url')
        ? redirect(Session::get('previous_productes_url'))
        : redirect()->route('producte.index');
    }

    public function show($id) {
        $compra = Compra::findOrFail($id);

        return view("admin.compres.show", compact(
            'compra'
        ));
    }

    public function update($id) {
        $result = Compra::where('id', $id)
                ->update([
                    'validat' => true
                ]);

        Session::put('return', [
            'msg' => $result ? 'Producte editat correctament.' : 'Error editant producte',
            'alert' => $result ? 'alert-success' : 'alert-warning'
        ]);

        return redirect()->route('admin.compra.index');
    }

    public function destroy($id) {
        $result = Compra::destroy($id);

        Session::put('return', [
            'msg' => $result ? 'Compra eliminada correctament.' : 'Error eliminant compra.',
            'alert' => $result ? 'alert-success' : 'alert-warning'
        ]);

        return redirect()->route('admin.compra.index');
    }

    public function admin() {
        $compres = Compra::join('users', 'compres.id_user', '=', 'users.id')
        ->select('compres.*', 'users.name')
        ->where('validat', '=', false)->paginate(20) ?? [];

        return view("admin.compres.index", compact(
            'compres'
        ));
    }
}
