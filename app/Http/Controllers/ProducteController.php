<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProducteController extends Controller
{
    public function index()
    {

    }

    public function show($id)
    {
        return view("productes.producte", ["id" => $id]);
    }
}
