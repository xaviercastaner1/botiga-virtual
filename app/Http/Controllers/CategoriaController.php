<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $categories = Categoria::all();

        return view("categories.categories", compact("categories"));
    }

    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view("categories.categoria", compact("categoria"));
    }
}
