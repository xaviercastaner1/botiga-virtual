<?php

namespace App\Http\Controllers;

use App\Models\Carret;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;

class CarretController extends Controller
{
    public function index() {

    }

    public function show($id) {

    }

    public function store(Request $request, $id) {
        /*Carret::create([

        ]);*/
        echo $id;
        //return redirect('productes.index', ['msg' => 'Producte agregat correctament']);
    }
}
