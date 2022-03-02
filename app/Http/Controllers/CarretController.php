<?php

namespace App\Http\Controllers;

use App\Models\Carret;
use App\Models\Producte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\VarDumper\VarDumper;

class CarretController extends Controller
{
    public function index() {

        //Session::flush();



        $carret = Session::get('carret') ?? [];
        $items = [];

        foreach($carret as $id => $item) {
            $items[] = [
                'producte' => Producte::findOrFail($id),
                'unitats' => $item[0]['unitats']
            ];

        }


        return view('carret.carret', compact('items'));
    }

    public function show($id) {

    }

    public function store($id) {


        if(Auth::check()) {

            $unitats = request('unitats') ?? 1;
            $producte = Producte::findOrFail($id);

            if(!Session::has('carret')) {
                Session::put('carret', []);
            }

            Session::push("carret.$id", ['unitats' => $unitats]);

            Session::put('return', [
                'msg' => 'Producte agregat correctament.',
                'alert' => 'alert-success'
            ]);

            return redirect(Session::get('previous_productes_url'));

        }

    }

    public function destroy($id) {

        $result = false;
        foreach(Session::get('carret') as $id_producte => $item) {

            if(intval($id_producte) == $id) {

                $result = Session::forget("carret.$id");

            }
        }

        if($result) {
            Session::put('return', [
                'msg' => $result ? 'Producte eliminat correctament.' : 'Error eliminant producte.',
                'alert' => $result ? 'alert-success' : 'alert-warning'
            ]);
        }

        return redirect()->route('carret.index');
    }
}
