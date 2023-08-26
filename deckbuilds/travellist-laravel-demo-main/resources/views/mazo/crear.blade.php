<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="{{ asset('font/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/crear.css') }}">
    <title>Crear Mazo</title>
</head>

<body>
    <header>
        <div class="navegador">
            <nav class="navbar navbar-expand-lg main-nav container-fluid">
                <a class="navbar-brand" href="{{ route('inicio') }}">
                    <img class="logo" src="{{ asset('img/logoDeck.png') }}">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainMenu"
                    aria-controls="mainMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar icon-bar-1"></span>
                    <span class="icon-bar icon-bar-2"></span>
                    <span class="icon-bar icon-bar-3"></span>
                </button>
                <span><a class="titPag" href="{{ route('inicio') }}">DeckBuilds</a></span>
                <div class="collapse navbar-collapse" id="mainMenu">
                    <div class="wrap">
                        <div class="search">
                            <form class="search" action="{{ route('listaPost') }}" method="POST">
                                @csrf
                            <input type="text" class="searchTerm" id="buscadorNav"  name="nombreCarta" placeholder="Buscador de mazos">
                            <button type="submit" class="searchButton" id="searchNav">
                                <i class="fa fa-search"></i>
                            </button>
                            </form>
                        </div>
                    </div>
                    <ul class="navbar-nav ml-auto text-uppercase f1">
                        <li>
                            <a href="{{ route('inicio') }}">Inicio</a>
                        </li>
                        <li>
                            <a href="{{ route('crearMazo') }}" class="active">Crea tu mazo</a>
                        </li>
                        <li>
                            <a href="{{ route('lista') }}">Lista de Mazos</a>
                        </li>
                        @if (Auth::guest())
                            <li>
                                <a href="{{ route('login') }}">Iniciar Sesión</a>
                            </li>
                        @else
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle user-action">Mi Perfil<b
                                        class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <a href="{{ route('perfil', Auth::id()) }}" class="ia"><i></i>Perfil</a>
                                    <a href="{{ route('logoutM') }}" class="ia"><i></i> Logout</a>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
        <div class="mobile-container">

            <!-- Top Navigation Menu -->
            <div class="topnav">
                <div class="flexible">
                <span><a class="titPag" href="{{ route('inicio') }}">DeckBuilds</a></span>
                <form class="search" action="{{ route('listaPost') }}" method="POST">
                    @csrf
                <input type="text" class="searchTerm" id="buscadorNav"  name="nombreCarta" placeholder="Buscador de mazos">
                <button type="submit" class="searchButton" id="searchNav">
                    <i class="fa fa-search"></i>
                </button>
                </form>
                </div>
              <div id="myLinks">
                <a href="{{ route('inicio') }}" class="active active-first">Inicio</a>
                <a href="{{ route('crearMazo') }}">Crea tu mazo</a>
                <a href="{{ route('lista') }}">Lista de Mazos</a>
                @if (Auth::guest())
                    <a href="{{ route('login') }}">Iniciar Sesión</a>
                @else
                <a href="{{ route('perfil', Auth::id()) }}" class="ia"><i></i>Perfil</a>
                                    <a href="{{ route('logoutM') }}" class="ia"><i></i> Logout</a>
                 @endif
              </div>
              <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
              </a>
            </div>
            <!-- End smartphone / tablet look -->
            </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <i class="fa fa-arrow-right flecha2" id="mostrar" aria-hidden="true"></i>
            <div class="col-lg-12 col-xl-6">
                <div id="cartas" class="container divCartas">
                   <div id="buscador" class="col-12 mb-5 mt-3 buscadorCard">
                       <div class="wrap">
                           <div class="search">
                               <input type="text" class="searchTerm" id="search" placeholder="Buscador de cartas">
                               <button type="submit" class="searchButton" id="cartasBuscar">
                                   <i class="fa fa-search"></i>
                               </button>
                               <i class="fa fa-arrow-left flecha" id="cerrar" aria-hidden="true"></i>
                            </div>
                       </div>
                    </div>
                    <div class="colores">
                        @foreach ($colores as $color)
                        @if ($color->id !=6)
                        <div>
                            <input type="checkbox" class="colorIP" value="{{ $color->id }}"
                                id="{{ $color->color }}"> <label class="colorLb">{{ $color->color }}</label>
                            </div>
                        @endif
                        @endforeach
                    </div>
                    <div id="listaCartasPadre" class="cartasPadre">
                        <div id="loading" class="loader">
                            Loading...<span>Cargando</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-6">
                <div id="lista" class="container divLista">
                    <div class="datosBM">
                        <div class="datos">
                            <label class="Estado">Nombre</label> <input type="text" id="nombreMazo"
                                class="form-control"> <label class="Estado">Formato</label> <select
                                id="formato" class="form-control">
                                <option value="" selected disabled hidden="">
                                </option>
                                <option value="Modern">
                                    Modern
                                </option>
                                <option value="Commander">
                                    Commander
                                </option>
                            </select> <label class="Estado">Estado</label>
                            <div class="switch-button">
                                <input class="switch-button-checkbox" type="checkbox" id="checkEs"> <label
                                    class="switch-button-label" for=""><span
                                        class="switch-button-label-span">Público</span></label>
                            </div>
                        </div>
                        <div class="dvPortada">
                            <label class="Estado">Portada del mazo</label> <img class="portada"
                                src="https://gatherer.wizards.com/Handlers/Image.ashx?multiverseid=170752&amp;type=card"
                                id="portMazo" alt="Image"> <button id="eliminarPortada" class="enviar">Eliminar
                                portada</button>
                        </div>
                    </div>
                    <div class="totalDiv">
                        <span>Nº de cartas: <span id="total" class="Total">0</span></span><button class="bt" id="btDes">Descripción</button>
                    </div>
                    <div id="listado" class="listadoCartas"></div>
                    <textarea class="area" id="descripcion"></textarea>
                    <div class="fForm">
                        <input type="submit" id="Enviar" value="Crear Mazo" class="enviar">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div>
            <ul>
               <li> <a href="{{ route('inicio') }}" >Inicio</a></li>
               <li><a href="{{ route('crearMazo') }}">Crea tu mazo</a></li>
               <li> <a href="{{ route('lista') }}">Lista de Mazos</a></li>
            </ul>
        </div>
        <div id="ccComons">
            <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Licencia de Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a>
        </div>
        <div>
            <p>Proyecto realizado gracias a Wizards of the Coast y Scryfall</p>
        </div>
        <div id="daw">
            <p>TFG DAW 2022</p>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/cartas.js') }}"></script>
    <script src="{{ asset('js/nav.js')}}"></script>
</body>

</html>
