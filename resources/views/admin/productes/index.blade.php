@extends('layouts.app')
@section('title', 'Productes')
@section('content')
<div class="container">

    <table class="table">

        <thead class="thead-dark">

            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Descripcio</th>
                <th scope="col">Imatge</th>
                <th scope="col">Preu</th>
                <th scope="col">Accions</th>
            </tr>

        </thead>

        <tbody>

        @foreach($productes as $producte)
            <tr>
                <td>{{$producte->nom}}</td>
                <td>{{$producte->descripcio}}</td>
                <td>
                    <img src="{{$producte->imatge}}" width="80">
                </td>
                <td>
                    <h4>{{$producte->preu}}€</h4>
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

    <div class="paginator mx-auto mt-5">
        {{ $productes->links('pagination::bootstrap-5') }}
    </div>

</div>
@stop
