@extends('layouts.app')
@section('title', "Compra $compra->id")
@section('content')
<div class="container">
    <h1>COMPRA Nº {{$compra->id}}</h1>
    <hr>

    <h3>Data de compra: {{$compra->data_compra}}</h3>
    <h3>Usuari: {{$compra["usuari"]->name}}</h3>

    <br><br>
    <h4>Productes demanats:</h4>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Descripcio</th>
                <th scope="col">Imatge</th>
                <th scope="col" class="text-center">Accions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($compra["productes"] as $producte)
            <tr>
                <td>{{$producte->id}}</td>
                <td>{{$producte->nom}}</td>
                <td>{{$producte->descripcio}}</td>
                <td>
                    <img src="{{$producte->imatge}}" width="80">
                </td>
                <td>
                    <div class="d-flex gap-3">
                        <a href="{{route('producte.edit', ['id' => $producte->id])}}"
                        class="btn btn-warning">Editar</a>
                        <form action="{{route('producte.destroy', ['id' => $producte->id])}}"
                        method="POST">
                        @csrf
                            <button class="btn btn-danger" type="submit">Eliminar</button>
                        </form>

                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop
