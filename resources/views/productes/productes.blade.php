@extends('layouts.app')

@section('title', ' - Productes')

@section('content')

    <div class="row">
        <div class="col-9">

            @if(Session::has('return'))
                <div class="w-25 ms-5 alert {{ Session::get('return')['alert'] }}">
                    {{Session::get('return')['msg']}}
                </div>
                {{ Session::forget('return') }}
            @endif

            <div class="row ms-5 gap-5 mb-5 productes">
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

            <form action="{{route('productes.index')}}" method="POST"
            class="w-75 form-filtres mb-5">
            @csrf
                <h2>BUSCAR</h2>
                <div class="d-flex gap-3 mb-3">
                    <img src="{{asset('assets/lupa.png')}}"
                    width="35" height="35">
                    <input type="text" name="filtres_buscar"
                    class="form-control" placeholder="Teclat..."
                    value="{{request('filtres_buscar') ?? ''}}">
                </div>

                <button type="submit"
                class="btn btn-primary">BUSCAR</button>
            </form>

            <form action="{{ route('producte.index') }}"
            method="POST" class="w-75 form-filtres">
            @csrf
                <h2>FILTRES</h2>

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
                    <label for="filtres_preu_maxim" class="form-label"><h4>Preu màxim:</h4></label>
                    <input type="range" class="form-range"
                    min="5" max="100" step="5" value="{{ $filtres_preu_maxim ?? 100 }}"
                    id="filtres_preu_maxim" name="filtres_preu_maxim"
                    oninput="document.querySelector('#preu-final').innerHTML = this.value">
                    <h4 id="preu-final">{{ $filtres_preu_maxim ?? '' }}</h4>
                </div>

                <hr>
                <h3>Ordenar per:</h3>
                <div class="d-flex justify-content-left gap-5 order-select">
                    <div class="d-flex flex-column justify-content-center">
                        <select name="filtres_ordenar" class="form-select">
                        @foreach($columnes as $columna)
                            <option value="{{strtolower($columna)}}"
                            {{ $filtres_ordenar == strtolower($columna) ? 'selected' : ''}}
                            >{{$columna}}</option>
                        @endforeach

                        </select>
                    </div>

                    <div class="order-method-checkbox">
                    @foreach($methods as $method => $method_title)
                        <input type="radio" name="ordenar_method"
                        value="{{$method}}" style="margin-right: 8px;"
                        {{ $ordenar_method == $method ? 'checked' : '' }}
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

            <form action="{{ route('productes.index') }}" method="GET"
            class="form-filtres mt-3">
            @csrf
                <button type="submit" id="reset-button"
                class="btn btn-warning">RESET</button>
            </form>

        </div>

    </div>

    <div class="paginator mx-auto mt-5">
        {{ $productes->appends([
            'filtres_proveidors' => $filtres_proveidors,
            'filtres_categories' => $filtres_categories,
            'filtres_preu_maxim' => $filtres_preu_maxim,
            'filtres_ordenar' => $filtres_ordenar,
            'ordenar_method' => $ordenar_method
            ])->links('pagination::bootstrap-5') }}
    </div>

@stop
