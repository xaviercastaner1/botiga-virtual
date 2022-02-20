@extends('layouts.app')
@section('title', '{{ $categoria->nom }}')
@section('content')
    <h1>Categoria {{ $categoria->nom }}</h1>
@stop
