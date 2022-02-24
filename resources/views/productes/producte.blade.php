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
                    <div>
                        <h3 class="producte-nom">{{ $producte->nom }} - {{ $producte->proveidor }}</h3>
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
                                <form action="{{ route('productes.store') }}"
                                method="POST">
                                
                                </form>
                            </div>

                        </div>



                    </div>

                </div>

            </div>
        </div>
        
    <a href="{{ url()->previous() }}">Tornar als productes</a>
    </div>
    

@stop
