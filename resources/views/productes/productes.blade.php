@extends('layouts.app')

@section('title', 'Productes')

@section('content')
    <div class="row ms-5 gap-5 productes">
        @foreach($productes as $producte)
            <div class="producte col-5">

                <a href="{{ route('producte.show', $producte->id) }}">

                    <h3>{{ $producte->nom }}</h3>
                    <img src="{{ $producte->imatge }}"
                    alt="{{ $producte->nom }}"
                    width="250">

                </a>

                <p class="mt-2">{{ $producte->descripcio }}</p>

            </div>
        @endforeach

        </div>

        <div class="paginator mx-auto mt-5">
            {{ $productes->links('pagination::bootstrap-5') }}
        </div>


        <div class="pagination-form mt-4">
            <form action="{{ route('productes.index') }}" method="POST" class="d-flex gap-4">
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
