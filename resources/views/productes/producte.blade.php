@extends('layouts.app')
@section('title', 'Producte')
@section('content')
    <div class="container">
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

                        <div class="producte-info ms-4 mt-2">
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
                                        style="width: 80px">
                                            <img src="{{asset('assets/shopping-cart.png')}}"
                                            width="25" class="carret-icon">
                                        </button>
                                    </div>

                                    <div class="total-multiplied-unitats mt-4">
                                        <h4>Total: <span class="resultat">{{$producte->preu}}€</span></h4>
                                    </div>

                                </form>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    <a href="{{ url()->previous() }}">
        <h3 class="mt-4">Tornar als productes</h3>
    </a>
    </div>


@stop
