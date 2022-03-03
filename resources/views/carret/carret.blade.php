@extends('layouts.app')
@section('title', 'Carret')
@section('content')
    <div class="container">

    <h1>CARRET</h1>
    <p>Tens {{count($items)}} productes al carret</p>
    <hr>

    @foreach($items as $item)
        <div class="d-flex gap-4">
            <div class="producte-container mb-4 w-75">

                <div class="box">
                    <div class="ribbon ribbon-top-right"><span>{{$item["producte"]->descompte}}%</span></div>
                </div>

                <div class="producte">
                    <a href="{{ route('producte.show', $item['producte']->id) }}">
                        <h3 class="producte-nom">{{ $item["producte"]->nom }} - {{ $item["producte"]->proveidor }}</h3>
                    </a>

                    <div class="d-flex">

                        <a href="{{ route('producte.show', $item['producte']->id) }}"
                        class="producte-a">

                            <img src="{{ $item['producte']->imatge }}"
                            alt="{{ $item["producte"]->nom }}"
                            width="200"
                            class="producte-img">

                        </a>

                        <div class="producte-info ms-4 mt-2">
                            <p class="mt-2 producte-desc">{{ $item["producte"]->descripcio }}</p>
                            <h4>Preu: {{ $item["producte"]->preu }}€</h4>
                            <p>Unitats restants: {{ $item["producte"]->stock }}</p>
                        </div>

                    </div>
                </div>

            </div>
            <div class="mt-5">
                <h1>Unitats: {{$item["unitats"]}}</h1>
                <form action="{{ route('carret.destroy', ['id' => $item['producte']->id]) }}"
                method="POST">
                @csrf
                    <button type="submit"
                    class="btn btn-danger mt-3">Eliminar</button>
                </form>
            </div>

        </div>

    @endforeach

    <h4>Total: {{$total}}€</h4>

    <form action="{{ route('producte.update') }}" method="POST">
    @csrf
        <button type="submit"
        class="btn btn-warning mt-4"
        style="padding: 10px 20px; 
        {{ count($items) == 0 ? 'display: none;' : '' }}">Comprar</button>
    </form>

    <a href="{{ Session::get('previous_productes_url') }}">
        <h3 class="mt-5">Tornar als productes</h3>
    </a>
    </div>


@stop
