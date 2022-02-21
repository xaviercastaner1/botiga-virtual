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

            <form action="{{ route('producte.index') }}" method="GET">
            
            @foreach($proveidors as $proveidor)
                <input type="checkbox" 
                name="proveidors_filtres[]" 
                {{ in_array($proveidor, $proveidors_filtres) ? 'checked' : '' }} 
                value="{{$proveidor}}"> {{$proveidor}} <br />
            @endforeach

                <button type="submit" class="btn btn-primary">SUBMIT</button>
            
            </form>

        </div>

    </div>

    <div class="paginator mx-auto mt-5">
        {{ $productes->links('pagination::bootstrap-5') }}
    </div>

    <div class="pagination-form mt-4">
        <form action="{{ route('productes.index') }}" method="POST" class="d-flex justify-content-center gap-4">
        @csrf
        <h3>Items per pàgina: </h3>
            <select name="items" onchange="this.form.submit()">

                @for($i = 1; $i < $countProductes / 2; $i++)

                    @if($items == $i)
                        <option selected value="{{$i}}">{{$i}}</option>
                    @else
                        <option value="{{$i}}">{{$i}}</option>
                    @endif

                @endfor

            </select>
        </form>
    </div>
    
@stop
