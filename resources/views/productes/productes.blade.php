@extends('layouts.app')

@section('title', ' - Productes')

@section('content')

    <div class="row">

    @isset($msg)
        <div class="alert alert-success" role="alert">
            {{$msg}}
        </div>
    @endisset
        <div class="col-9">
            <div class="row ms-5 gap-5 productes">
            @foreach($productes as $producte)
                <div class="producte-container col">

                    <div class="box">
                        <div class="ribbon ribbon-top-right"><span>{{$producte->descompte}}%</span></div>
                    </div>

                    <div class="producte">
                        <a href="{{ route('producte.show', $producte->id) }}">
                            <h3 class="producte-nom">{{ $producte->nom }} - {{ $producte->proveidor }}</h3>
                        </a>

                        <div class="d-flex">

                            <a href="{{ route('producte.show', $producte->id) }}"
                            class="producte-a">

                                <img src="{{ $producte->imatge }}"
                                alt="{{ $producte->nom }}"
                                width="200"
                                class="producte-img">

                            </a>

                            <div class="producte-info ms-4 mt-2">
                                <p class="mt-2 producte-desc">{{ $producte->descripcio }}</p>
                                <h4>Preu: {{ $producte->preu }}€</h4>
                                <p>Unitats restants: {{ $producte->stock }}</p>
                            </div>

                        </div>
                    </div>

                </div>
            @endforeach

            </div>
        </div>

        <div class="col">

            <form action="{{ route('producte.index') }}"
            method="GET" id="form-filtres" class="w-75">
            @csrf
                <h1>FILTRES</h1>

                <hr>
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
                    <label for="preu-maxim" class="form-label"><h4>Preu màxim:</h4></label>
                    <input type="range" class="form-range"
                    min="5" max="100" step="5" value="{{ $filtres_preuMaxim ?? 100 }}"
                    id="preu-maxim" name="preu-maxim"
                    oninput="document.querySelector('#preu-final').innerHTML = this.value">
                    <h4 id="preu-final">{{ $filtres_preuMaxim ?? '' }}</h4>
                </div>

                <hr>
                <h3>Ordenar per:</h3>
                <div class="d-flex justify-content-left gap-5 order-select">
                    <div class="d-flex flex-column justify-content-center">
                        <select name="filtres_ordenar" class="form-select">
                        @foreach($columnes as $columna)
                            <option value="{{strtolower($columna)}}"
                            {{ request('filtres_ordenar') == strtolower($columna) ? 'selected' : ''}}
                            >{{$columna}}</option>
                        @endforeach

                        </select>
                    </div>

                    <div class="order-method-checkbox">
                    @foreach($methods as $method => $method_title)
                        <input type="radio" name="ordenar_method"
                        value="{{$method}}"
                        {{ request('ordenar_method') == $method ? 'checked' : '' }}
                        >{{$method_title}}<br/>
                    @endforeach
                    </div>

                </div>

                <br>
                <div class="d-flex gap-3">

                    <button type="submit" id="submit-button"
                    class="btn btn-primary">FILTRAR</button>

                </div>

            </form>

        </div>

    </div>

    <div class="paginator mx-auto mt-5">
        {{ $productes->links('pagination::bootstrap-5') }}
    </div>

@stop
