<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://ayuper.es/wp-content/uploads/2018/03/cropped-logotipo_opt-32x32.png" sizes="32x32" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-transparent-gray navbar-laravel fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="https://ayuper.es/wp-content/uploads/2018/03/logotipo_opt-1.png" height="30" alt="">
                    
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="https://ayuper.es/blog/">Blog</a>
                            </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">encuentra tu trabajo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('alta') }}">localiza tu ayuper!</a>
                            </li>
                        @else
                            
                            @if(Auth::user()->notificaciones->where('estatus',1)->count() > 0)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Notificaciones</a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->estatus == 1)

                                    @foreach(Auth::user()->notificaciones->where('estatus',1) as $not)
                                    <a href="{{ route('notificacion' , $not->id) }}" class="dropdown-item">
                                        {{ $not->detalles }}
                                    </a>
                                    @endforeach

                                    @else

                                    @endif

                                </div>
                            </li>
                            @endif

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ title_case(Auth::user()->name) }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('perfil') }}" class="dropdown-item">
                                        Perfil
                                    </a>
                                   
                                    <!--<a href="{{ route('notificaciones') }}" class="dropdown-item">
                                        Notificaciones
                                    </a>-->
                                    <a href="{{ route('mistareas') }}" class="dropdown-item d-flex justify-content-between align-items-center">
                                        Mis tareas {{ Auth::user()->tareas->count() }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="banner"></div>

        <main class="py-4">
            @yield('content')
        </main>
        <footer class="bg-dark text-light p-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h6>NUESTROS PRODUCTOS Y SERVICIOS</h6>
                        <a href="https://ayuper.es/limpieza-de-tu-casa-en-madrid/" class="d-block mb-3">
                            Limpieza de tu hogar en Madrid
                        </a>
                        <a href="https://ayuper.es/cuidado-de-tu-mascota-en-madrid/" class="d-block mb-3">
                            Cuidado de tu mascota en Madrid
                        </a>
                        <a href="https://ayuper.es/chef-a-domicilio-en-madrid/" class="d-block mb-3">
                            Chef a domicilio en Madrid
                        </a>
                        <a href="https://ayuper.es/lavanderia-planchado-ropa-madrid/" class="d-block mb-3">
                            Lavandería y plancha en Madrid
                        </a>
                    </div>
                    <div class="col-md-3">
                        <h6>CONTACTE CON NOSOTROS</h6>
                        <p class="d-block">911 39 72 01</p>
                        <p class="d-block">hola@ayuper.es</p>
                        <p class="d-block">Términos y condiciones</p>
                        <p class="d-block">Política de privacidad</p>
                        <p class="d-block">Diseñado con mucho ❤ para ayuper!</p>
                    </div>
                    <div class="col-md-3">
                        <h6>AYUPER – TU AYUDANTE PERSONAL</h6>
                        <p>Tu ayudante personal, nos dedicamos a buscar profesionales de confianza para ayudarte en las tareas de tu hogar como en la limpieza de tu casa o apartamento, chef a domicilio, cuidado de tu mascota y planchado de tu ropa, todo con tu móvil.</p>
                    </div>
                    <div class="col-md-3">
                        <h6>SIGUE A NUESTROS AYUPER EN NUESTRAS REDES SOCIALES</h6>
                        <a href="https://ayuper.es/">Facebook</a>
                        <a href="https://ayuper.es/">LinkedIn</a>
                    </div>
                </div>

               
            </div>

        </footer>

        <footer class="text-light pt-3" style="background: #282a2b">
            <div class="container">
                 <div class="row">
                    <div class="col text-center">
                        <p> © Copyright 2012 - 2018 Ayuper.es Todos los derechos reservados</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @yield('scripts')
</body>
</html>
