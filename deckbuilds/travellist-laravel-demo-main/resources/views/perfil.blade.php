<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Perfil</title>
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
                            <a href="{{ route('inicio') }}" >Inicio</a>
                        </li>
                        <li>
                            <a href="{{ route('crearMazo') }}">Crea tu mazo</a>
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
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle user-action active">Mi Perfil<b
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
    <div class="userBox">
        <h1>Perfil de {{$user->name}}</h1>
        <div>
            <img src="{{asset('/img/user/'.$user->avatar)}}"
                class="perfil">
        </div>
        @if (  !Auth::guest() && Auth::id()== $user->id)
       <form action="{{ route('foto')}}" method="POST" enctype="multipart/form-data"> 
        @csrf 
        <div class="ajustar">
        <input type="file" name="imagen" class="crearB" accept="image/png">
        </div>
        <button class="crearB" type="submit">Guardar</button>
       </form>
       @endif
       <div class="ordenarDatos">
        <div class="divDatos">
            @if ( Auth::id()== $user->id)
            <label>Email</label>
            <input type="text" class="form-control" readonly placeholder="{{$user->email}}">
            @endif
            <label>Usuario Desde</label>
            <input type="text" class="form-control" readOnly placeHolder="{{$user->created_at}}">
        </div>
       </div>
    </div>
    <div class="separacion">
        @if ( !Auth::guest() && Auth::id()== $user->id)  
    <h2 class="cCM">Mis mazos</h2>
    @else
    <h2 class="cCM">Mazos de {{$user->name}}</h2>
     @endif
    </div>

    <div class="MisMazos">
        <section class="wrapper">
            <div class="container cartas">
                <div class="row">
                    @foreach ($user->mazos as $mazo)
                    @if ($mazo->estado=="Publico" || !Auth::guest() && Auth::id()== $user->id)
                    <div class="col-md-8 col-lg-6 col-xl-6">
                        <div class="card text-white card-has-bg click-col"
                            style="background-image:url('{{ $mazo->portada }}');
                             border-radius:20px;">
                            <img class="card-img d-none"
                                src="{{ $mazo->portada }}"
                                alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
                            <div class="card-img-overlay d-flex flex-column">
                                <div class="card-body">
                                    <small class="card-meta mb-2">{{ $mazo->formato }}</small>
                                    <h4 class="card-title mt-0 "><a class="text-white href"
                                        href="{{ route('mazoGet', $mazo->id) }}">{{ $mazo->nombre }}</a></h4>
                                    <small><i class="far fa-clock"></i>Visitas Semanales: {{ $mazo->visitas}}</small>
                                </div>
                                <div class="card-footer">
                                    <div class="media">
                                        <img class="mr-3 rounded-circle circulo"
                                            src="{{asset('/img/user/'.$mazo->user->avatar)}}"
                                            alt="Generic placeholder image" style="max-width:50px">
                                        <div class="media-body">
                                            <h6 class="my-0 text-white d-block mt-3"><a  class="text-white href" href="{{ route('perfil',$mazo->user->id)}}">{{ $mazo->user->name }}</a></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </section>   
    </div>
    <div class="separacion">
        @if ( !Auth::guest() && Auth::id()== $user->id)  
    <h2 class="cCM">Mis Favoritos</h2>
    @else
    <h2 class="cCM">Favoritos de {{$user->name}}</h2>
     @endif
    </div>

    <div class="MisMazos" id="separar">
        <section class="wrapper" >
            <div class="container cartas">
                <div class="row">
                    @foreach ($user->favoritos as $mazo)
                    @if ($mazo->estado=="Publico" || !Auth::guest() && Auth::id()== $user->id)
                    <div class="col-md-8 col-lg-6 col-xl-6">
                        <div class="card text-white card-has-bg click-col"
                            style="background-image:url('{{ $mazo->portada }}');
                             border-radius:20px;">
                            <img class="card-img d-none"
                                src="{{ $mazo->portada }}"
                                alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
                            <div class="card-img-overlay d-flex flex-column">
                                <div class="card-body">
                                    <small class="card-meta mb-2">{{ $mazo->formato }}</small>
                                    <h4 class="card-title mt-0 "><a class="text-white href"
                                        href="{{ route('mazoGet', $mazo->id) }}">{{ $mazo->nombre }}</a></h4>
                                    <small><i class="far fa-clock"></i>Visitas Semanales: {{ $mazo->visitas}}</small>
                                </div>
                                <div class="card-footer">
                                    <div class="media">
                                        <img class="mr-3 rounded-circle circulo"
                                            src="{{asset('/img/user/'.$mazo->user->avatar)}}"
                                            alt="Generic placeholder image" style="max-width:50px">
                                        <div class="media-body">
                                            <h6 class="my-0 text-white d-block mt-3"><a  class="text-white href" href="{{ route('perfil',$mazo->user->id)}}">{{ $mazo->user->name }}</a></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </section>   
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
   <script src="{{ asset('js/nav.js')}}"></script>
</body>

</html>
