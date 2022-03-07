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
    <div class="producte-container">
        <div class="producte-container producte-container-show col">

            <div class="box">
                <div class="ribbon ribbon-top-right"><span>{{$producte->descompte}}%</span></div>
            </div>

            <div class="producte">
                <div class="mt-3 ms-4">
                    <h1 class="producte-nom">{{ $producte->nom }} - {{ $producte->proveidor }}</h1>
                </div>

                <div class="d-flex">

                    <div class="producte-a">

                        <img src="{{ $producte->imatge }}"
                        alt="{{ $producte->nom }}"
                        width="400"
                        class="producte-img">

                    </div>

                    <div class="producte-info ms-5 mt-2">
                        <p class="mt-2 producte-desc producte-desc-show">{{ $producte->descripcio }}</p>
                        <h4>Preu: {{ $producte->preu }}€</h4>
                        <p>Unitats restants: {{ $producte->stock }}</p>

                        <hr class="w-75">
                        <div class="unitats-form">
                            <form action="{{ route('carret.store', ['id' => $producte->id]) }}"
                            method="POST">
                            @csrf
                                <div class="d-flex gap-3">
                                    <input type="hidden" id="preu" value="{{$producte->preu}}">

                                    <input type="number" min="1" max="{{$producte->stock}}"
                                    value="1" name="unitats" class="form-control" style="width: 70px"
                                    oninput="document.querySelector('.resultat').innerHTML = `${(this.value * document.querySelector('#preu').value)}€`">
                                    <button class="btn btn-primary d-flex justify-content-center"
                                    style="width: 80px"
                                    {{ !Auth::check() ? 'disabled' : '' }}>
                                        <img src="{{asset('assets/shopping-cart.png')}}"
                                        width="25" class="carret-icon">
                                    </button>
                                    <small>{{ !Auth::check() ? 'Has d\'estar loguejat per afegir productes' : '' }}</small>

                                </div>

                                <div class="total-multiplied-unitats mt-4 mb-5">
                                    <h4>Total: <span class="resultat">{{$producte->preu}}€</span></h4>
                                </div>


                            </form>

                            @if (Auth::check() && auth()->user()->admin)
                                <div class="d-flex gap-3 flex-grow">
                                    <h3>Accions d'administrador:</h3>

                                    <div class="btn-group dropend">
                                        <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Accions
                                        </button>
                                        <ul class="dropdown-menu">

                                            <li>
                                                <form action="{{route('producte.destroy', ['id' => $producte->id])}}" method="POST">
                                                @csrf
                                                    <button type="submit"
                                                    class="dropdown-item">Eliminar</button>
                                                </form>
                                            </li>

                                            <li>
                                                <a class="dropdown-item" href="{{route('producte.edit', ['id' => $producte->id])}}">
                                                    Editar
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                            @endif
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

    <a href="{{$productes_url}}">
        <h3 class="mt-4" style="display: inline-block;">Tornar als productes</h3>
    </a>
</div>

@stop
