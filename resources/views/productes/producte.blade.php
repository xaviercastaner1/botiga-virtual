@extends('layouts.app')
@section('title', 'Producte')
@section('content')
    <div class="producte">
        <h1>PRODUCTE: {{ $producte->nom }}</h1>
        <img src="{{ $producte->imatge }}" width="500">
    </div>
    <a href="{{ route('producte.index') }}">Tornar als productes</a>

@stop
