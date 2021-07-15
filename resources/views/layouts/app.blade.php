<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Controle UNIASSELVI</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/geral.css') }}" rel="stylesheet">
    <!--Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/f4ac5dc6e7.js" crossorigin="anonymous"></script>

    @yield('estiloPersonalizado')

</head>
<body>
    <div id="app">
        <div id="nav-menu" class="col-12 fixed-top p-0">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <div id="div-botao-menu-lateral" class="navbar-brand p-0">
                        <span class="icone-menu-lateral btn-menu-lateral">
                            <b>MENU</b>
                        </span>
                    </div>
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
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-primary">Sair</button>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
        </div>

        <div id="barra-menu-lateral" class="col-12 col-md-3 col-xl-2 position-fixed">
            <div class="col-12 p-0 text-right">
                <i class="btn-menu-lateral fas fa-times-circle"></i>
            </div>
            <div class="col-12 text-center">
                <div class="col-12 p-0">
                    <a href="{{url('/')}}">Home</a>
                </div>
                <div class="col-12 p-0">
                    <a href="{{url('/')}}/clientes">Clientes</a>
                </div>
                <div class="col-12 p-0">
                    <a href="{{url('/')}}/produtos">Produtos</a>
                </div>
                <div class="col-12 p-0">
                    <a href="{{url('/')}}/pedidos">Pedidos</a>
                </div>
                <div class="col-12 p-0">
                    <a href="{{url('/')}}/register">Cadastrar usuário</a>
                </div>
            </div>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!--Bootstrap 4.1 JS-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="{{ asset('js/jquery.mask.js') }}"></script>
    <script src="{{ asset('js/layoutGeral.js') }}"></script>
    
    @yield('scriptPersonalizado')
    
</body>
</html>
