@extends('template')
@section('titulo', 'Home')
@section('content')
    @for($i = 0; $i<20; $i++)
        <h1>PRODUCTE {{ $i }}</h1>
    @endfor
@stop
