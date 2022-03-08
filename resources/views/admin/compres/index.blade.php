@extends('layouts.app')
@section('title', 'Compres')
@section('content')
<div class="container" style="min-height: 400px">
    <h1>COMPRES PENDENTS</h1>
    <hr>

    <table class="table">

        <thead class="thead-dark">

            <tr>
                <th scope="col">Id Compra</th>
                <th scope="col">Data Compra</th>
                <th scope="col">Usuari</th>
                <th scope="col">Productes</th>
                <th scope="col">Accions</th>
            </tr>

        </thead>

        <tbody>

        @foreach($compres as $compra)
            <tr>
                <td>{{$compra->id}}</td>
                <td>{{$compra->data_compra}}</td>
                <td>{{$compra->name}}</td>
                <td>{{$compra->productes}}</td>
                <td>
                    <div class="d-flex gap-3">
                        <form action="{{route('compra.update', ['id' => $compra->id])}}"
                        method="POST">
                        @csrf
                            <button class="btn btn-info" type="submit">Validar</button>
                        </form>
                        <form action="{{route('compra.destroy', ['id' => $compra->id])}}"
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
        {{ $compres->links('pagination::bootstrap-5') }}
    </div>
</div>
@stop
