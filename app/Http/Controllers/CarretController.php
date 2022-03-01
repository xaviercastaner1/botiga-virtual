<?php

namespace App\Http\Controllers;

use App\Models\Carret;
use App\Models\Producte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;

class CarretController extends Controller
{
    public function index() {

        $carret = Session::get('carret') ?? [];
        $items = [];

        foreach($carret as $item) {
            $items[] = [
                'producte' => Producte::findOrFail($item['id_producte']),
                'unitats' => $item['unitats']
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

            Session::push("carret", [
                'id_producte' => $id,
                'unitats' => $unitats
            ]);

            Session::put('return', [
                'msg' => 'Producte agregat correctament.',
                'alert' => 'alert-success'
            ]);

            return redirect()->route('productes.index');

        }

    }

    public function destroy($id) {
        Session::forget("carret.$id");
    }
}
