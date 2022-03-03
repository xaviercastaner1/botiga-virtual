@extends('layouts.app')
@section('title', 'Producte')
@section('content')
    <div class="container">
        <h1>{{$user->name}}</h1>
        <hr><br>

        <form action="{{ route('user.update', ['id' => Auth::id()]) }}" 
        method="POST" class="w-75">

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" value="{{$user->name}}" 
                name="nom" class="form-control ">
            </div><br>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" value="{{$user->email}}"
                name="email" class="form-control ">
            </div><br>

            <div class="form-group">
                <label for="email">Password</label>
                <input type="password" value="{{$user->password}}"
                name="email" class="form-control ">
            </div><br>
            
        </form>
    </div>
@stop