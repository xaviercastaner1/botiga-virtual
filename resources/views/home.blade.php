@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-4">
         <div class="card text-white card-has-bg click-col" style="background-image:url('{{asset('assets/shopping.jpg')}}');">
            <img class="card-img d-none" src="{{asset('assets/shopping.jpg')}}" alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
            <div class="card-img-overlay d-flex flex-column">
               <div class="card-body">
                  <small class="card-meta mb-2">Recursivitat</small>
                  <h4 class="card-title mt-0 "><a class="text-white"
                  href="{{ route('home') }}">Fes click aquí per un bucle inifinit d'accés al home</a></h4>
                  <small><i class="far fa-clock"></i> October 15, 2020</small>
               </div>
               <div class="card-footer">
                  <h3>HOME</h3>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-4">
         <div class="card text-white card-has-bg click-col" style="background-image:url('{{asset('assets/shopping.jpg')}}');">
            <img class="card-img d-none" src="{{asset('assets/shopping.jpg')}}" alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
            <div class="card-img-overlay d-flex flex-column">
               <div class="card-body">
                  <small class="card-meta mb-2">Components d'ordinador</small>
                  <h4 class="card-title mt-0 "><a class="text-white"
                  href="{{ route('productes.index') }}">Explora tots els nostres productes disponibles</a></h4>
               </div>
               <div class="card-footer">
                  <h3>PRODUCTES</h3>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-4">
         <div class="card text-white card-has-bg click-col" style="background-image:url('https://source.unsplash.com/600x900/?computer,design');">
            <img class="card-img d-none" src="https://source.unsplash.com/600x900/?computer,design" alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
            <div class="card-img-overlay d-flex flex-column">
               <div class="card-body">
                  <small class="card-meta mb-2">Tens cap dubte?</small>
                  <h4 class="card-title mt-0 "><a class="text-white"
                  href="{{ route('contacte.index') }}">Aprofita el nostre formulari de contacte o xarxes socials</a></h4>
                  <small><i class="far fa-clock"></i> October 15, 2020</small>
               </div>
               <div class="card-footer">
                  <h3>CONTACTE</h3>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
