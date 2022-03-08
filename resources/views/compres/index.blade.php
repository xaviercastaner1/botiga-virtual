@extends('layouts.app')
@section('title', 'Compres')
@section('content')
<div class="container" style="min-height: 400px">
    <h1>COMPRES</h1>
    <hr>

    <table class="table">

        <thead class="thead-dark">

            <tr>
                <th scope="col">Id Compra</th>
                <th scope="col">Data Compra</th>
                <th scope="col">Productes</th>
                <th scope="col">Validat</th>
            </tr>

        </thead>

        <tbody>

        @foreach($compres as $compra)
            <tr>
                <td>{{$compra->id}}</td>
                <td>{{$compra->data_compra}}</td>
                <td>{{$compra->productes}}</td>
                <td>{{$compra->validat ? 'Sí' : 'No'}}</td>
            </tr>
        @endforeach

        </tbody>

    </table>

    <div class="paginator mx-auto mt-5">
        {{ $compres->links('pagination::bootstrap-5') }}
    </div>
</div>
@stop
