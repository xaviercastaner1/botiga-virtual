@extends('layouts.app')

@section('title', ' - Productes')

@section('content')

    <div class="row">

        <div class="col-9">
            <div class="row ms-5 gap-5 productes">
            @foreach($productes as $producte)
                <div class="producte col">

                    <a href="{{ route('producte.show', $producte->id) }}">
                        <h3 class="producte-nom">{{ $producte->nom }} - {{ $producte->proveidor }}</h3>
                    </a>

                    <div class="d-flex">

                        <a href="{{ route('producte.show', $producte->id) }}" class="producte-a">

                            <img src="{{ $producte->imatge }}"
                            alt="{{ $producte->nom }}"
                            width="200">

                        </a>

                        <div class="producte-info ms-4 mt-2">
                            <div class="descompte">{{ $producte->descompte }}%</div>
                            <p class="mt-2">{{ $producte->descripcio }}</p>
                            <h4>Preu: {{ $producte->preu }}€</h4>
                            <p>Unitats restants: {{ $producte->stock }}</p>
                        </div>

                    </div>


                </div>
            @endforeach

            </div>
        </div>

        <div class="col">
            <h1>FILTRES</h1>
            <hr>

            <form action="{{ route('producte.index') }}" method="POST" id="form-filtres">
            @csrf
            <h3>Proveidor: </h3>
            @foreach($proveidors as $proveidor)
                <input type="checkbox"
                name="filtres_proveidors[]"
                {{ in_array($proveidor, $filtres_proveidors) ? 'checked' : '' }}
                value="{{$proveidor}}"> {{$proveidor}} <br />
            @endforeach

            <hr>
            <h3>Categoria: </h3>
            @foreach($categories as $categoria)
                <input type="checkbox"
                name="filtres_categories[]"
                {{ in_array($categoria, $filtres_categories) ? 'checked' : '' }}
                value="{{$categoria}}"> {{$categoria}} <br />
            @endforeach

            <hr>
            <div class="form-group w-50">
                <label for="preu-maxim" class="form-label">Preu màxim: </label>
                <input type="range" class="form-range"
                min="5" max="100" step="5" value="{{ $filtres_preuMaxim ?? 100 }}"
                id="preu-maxim" name="preu-maxim"
                oninput="document.querySelector('#preu-final').innerHTML = this.value">
                <p id="preu-final">{{ $filtres_preuMaxim ?? '' }}</p>
            </div>

                <div class="d-flex gap-3">
                    <button type="submit"
                    name="filtres-action"
                    value="submit"
                    class="btn btn-primary">SUBMIT</button>

                    <button type="submit"
                    name="filtres-action"
                    value="reset"
                    class="btn btn-warning">RESET</button>
                </div>


            </form>

        </div>

    </div>

    <div class="paginator mx-auto mt-5">
        {{ $productes->links('pagination::bootstrap-5') }}
    </div>

    {{--<div class="pagination-form mt-4">
        <form action="{{ route('productes.index') }}" method="POST" class="d-flex justify-content-center gap-4">
        @csrf
            <h3>Items per pàgina: </h3>
            <select name="items" onchange="this.form.submit()">

                @for($i = 1; $i < $countProductes / 2; $i++)

                    <option {{ ($items == $i) ? 'selected' : '' }} value="{{$i}}">{{$i}}</option>

                @endfor

            </select>
        </form>
    </div>--}}

@stop
