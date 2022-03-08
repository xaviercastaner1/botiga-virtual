<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Components PC @yield('title')</title>
    <link rel="icon" href="{{ asset('assets/icon.png') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="Scripts/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="Scripts/bootstrap.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-4" style="background-color: rgb(255, 240, 101)!important">
            <div class="d-flex justify-content-center w-100" style="padding-left: 40px; padding-right: 40px">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <div class="d-flex">
                        <div class="d-flex flex-column justify-content-center">
                            <h3>COMPONENTS PC</h3>
                        </div>
                        <img src="{{ asset('assets/icon.png') }}" width="80" class="ms-3">
                    </div>

                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                            @if (auth()->user()->admin)
                                <div class="btn-group" style="margin-right: 15px">
                                    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Administrador
                                    </button>
                                    <ul class="dropdown-menu">

                                        <li>
                                            <a class="dropdown-item" href="{{route('admin.compra.index')}}">
                                                Compres
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="{{route('admin.producte.index')}}">
                                                Productes
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                                <a class="nav-link" role="button" aria-haspopup="true"
                                href="{{route('producte.create')}}">
                                    Afegir producte
                                </a>
                            @endif

                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('user.show', ['id' => Auth::id()]) }}">
                                        {{ __('Perfil') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('compra.index') }}">
                                        {{ __('Compres') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                            <div>
                                <a href="{{route('carret.index')}}" style="margin-right: 20px"
                                class="carret-header">
                                    <img src="{{asset('assets/shopping-cart.png')}}" width="40">
                                </a>
                            </div>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        @includeIf('layouts.footer')

    </div>
</body>
</html>
