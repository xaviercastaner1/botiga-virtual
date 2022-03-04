@extends('layouts.app')
@section('title', 'Producte')
@section('content')
<div class="container">
    @if(Session::has('return'))
        <div class="w-25 alert {{ Session::get('return')['alert'] }}">
            {{Session::get('return')['msg']}}
        </div>
        {{ Session::forget('return') }}
    @endif

    <h1>CREAR PRODUCTE</h1>
    <hr>

    <form action="{{route('producte.store')}}" method="POST" class="w-75">
    @csrf
        <div class="d-flex flex-column gap-3">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" name="nom" class="form-control">
            </div>

            <div class="form-group">
                <label for="descripcio">Descripcio:</label>
                <input type="text" name="descripcio" class="form-control">
            </div>

            <div class="form-group">
                <label for="imatge">Imatge (url):</label>
                <input type="text" name="imatge" class="form-control">
            </div>

            <div class="d-flex gap-5">
                <div class="form-group w-100">
                    <label for="preu">Preu:</label>
                    <input type="number" name="preu" class="form-control"
                    min="1" placeholder="100€">
                </div>

                <div class="form-group w-100">
                    <label for="descompte">Descompte:</label>
                    <input type="number" name="descompte" class="form-control"
                    placeholder="15%" max="99">
                </div>

                <div class="form-group w-100">
                    <label for="stock">Stock:</label>
                    <input type="number" name="stock" class="form-control"
                    placeholder="50">
                </div>
            </div>

            <div class="d-flex gap-5">
                <div class="form-group w-100">
                    <label for="proveidor">Proveidor:</label>
                    <select name="proveidor" class="form-select">
                    @foreach($proveidors as $proveidor)
                        <option value="{{$proveidor}}">
                            {{$proveidor}}
                        </option>
                    @endforeach
                    </select>
                </div>

                <div class="form-group w-100">
                    <label for="categoria">Categoria:</label>
                    <select name="categoria" class="form-select">
                    @foreach($categories as $categoria)
                        <option value="{{$categoria}}">
                            {{$categoria}}
                        </option>
                    @endforeach
                    </select>
                </div>
            </div>

        </div>

        <button type="submit"
        class="btn btn-primary mt-4">Crear</button>

    </form>
</div>
@stop
