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
                <th scope="col" style="width: 50%">Productes</th>
                <th scope="col">Validat</th>
            </tr>

        </thead>

        <tbody>

        @foreach($compresArr as $id => $compra)
            <tr>
                <td>{{$id}}</td>
                <td>{{$compra['compra']->data_compra}}</td>
                <td>
                    <div class="d-flex flex-wrap gap-2">
                    @foreach ($compra['productes'] as $producte)
                        <a class="compra-item btn btn-light"
                        href="{{route('producte.show', ['id' => $producte->id])}}">{{$producte->nom}}</a>
                    @endforeach
                    </div>

                </td>
                <td>
                    <p>{{$compra['compra']->validat ? 'Sí' : 'No'}}</p>
                </td>
            </tr>
        @endforeach

        </tbody>

    </table>

</div>
@stop
