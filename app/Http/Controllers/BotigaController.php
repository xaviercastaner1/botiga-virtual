<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BotigaController extends Controller
{
    public function index() {
        return view("botiga.botiga");
    }

    public function show($id) {
        return view("botiga.producte", ["id" => $id]);
    }
}
