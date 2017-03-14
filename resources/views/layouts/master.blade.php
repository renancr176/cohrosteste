<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>{{ config('app.name', 'Teste Cohros') }}</title>
        
        @section('styles')
        
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/master.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
        @show
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('home') }}"><strong>{{ config('app.name', 'Teste Cohros') }}</strong></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav"> 
                        <li>
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li>
                            
                            <a href="{{ route('contact') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Agenda <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('contact') }}">Agenda</a></li>
                                <li><a href="{{ route('contact.create') }}">Inserir Contato</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login <i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
                            <li><a href="{{ route('register') }}">Registre-se</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Sair <i class="fa fa-sign-out" aria-hidden="true"></i>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
        
        <footer class="master">
            <div class="container">
                <h5>© Copyright 2017 {{ config('app.name', 'Teste Cohros') }}</h5>
                <div>
                    <i class="fa fa-html5 fa-2x" aria-hidden="true"></i>
                    <span style="margin-left: 35px;">&nbsp;</span>
                    <i class="fa fa-css3 fa-2x" aria-hidden="true"></i>
                </div>
                <div>
                    <i class="fa fa-android fa-2x"></i>
                    <span style="margin-left: 30px;">&nbsp;</span>
                    <i class="fa fa-windows fa-2x"></i>
                    <span style="margin-left: 30px;">&nbsp;</span>
                    <i class="fa fa-apple fa-2x"></i>
                </div>
            </div>
        </footer>

        @section('scripts')
        
        <script src="/js/jquery-3.1.1.min.js"></script>
        <script src="/js/app.js"></script>
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
        @show
    </body>
</html>
