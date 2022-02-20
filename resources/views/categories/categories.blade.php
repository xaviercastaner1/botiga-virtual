@extends('layouts.app')
@section('title', 'Categories')
@section('content')
<h1>CATEGORIES</h1>
@foreach($categories as $categoria)
        <a href="{{ route("") }}">{{$categoria->nom}}</a>
@endforeach

@stop
