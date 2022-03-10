@extends('layouts.app')
@section('title', 'Proveidors')
@section('content')
<div class="container">
@if(Session::has('return'))
    <div class="w-25 alert {{ Session::get('return')['alert'] }}">
        {{Session::get('return')['msg']}}
    </div>
    {{ Session::forget('return') }}
@endif
    <div class="d-flex gap-3 flex-grow">

        <h1>CATEGORIES</h1>
        <div class="btn-group dropend">
            <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Accions
            </button>
            <ul class="dropdown-menu">

                <li>
                    <div class="dropdown-item">
                        <p>Crear Proveidor</p>
                        <form action="{{route('proveidor.store')}}" method="POST">
                        @csrf
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" name="nom" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary mt-2">Crear</button>
                        </form>
                    </div>
                </li>

            </ul>
        </div>
    </div>

    <hr>

    <table class="table w-75 mx-auto">

        <thead class="thead-dark">

            <tr>
                <th scope="col">Nom Proveidor</th>
                <th scope="col">Accions</th>
            </tr>

        </thead>

        <tbody>

        @foreach($proveidors as $proveidor)
            <tr>
                <td>{{$proveidor->nom}}</td>
                <td>
                    <div class="d-flex gap-3">

                        <form action="{{route('proveidor.destroy', ['nom' => $proveidor->nom])}}"
                        method="POST">
                        @csrf
                            <button class="btn btn-danger" type="submit">X</button>
                        </form>

                    </div>
                </td>
            </tr>
        @endforeach

        </tbody>

    </table>
</div>
@stop
