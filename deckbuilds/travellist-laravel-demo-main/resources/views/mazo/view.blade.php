<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/crear.css') }}">
        <link rel="stylesheet" href="{{ asset('css/view.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
    <title>Mazo</title>
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
                                <input type="text" class="searchTerm" id="buscadorNav" name="nombreCarta"
                                    placeholder="Buscador de mazos">
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
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle user-action">Mi Perfil<b
                                        class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <a href="{{ route('perfil', Auth::id()) }}"
                                        class="ia"><i></i>Perfil</a>
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
                        <input type="text" class="searchTerm" id="buscadorNav" name="nombreCarta"
                            placeholder="Buscador de mazos">
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
    <div id="vista">
        <div class="Titulo">
            <h1>{{ $mazo->nombre }}</h1>
            <div class="Usuario">
               <a href="{{ route('perfil', $mazo->user->id)}}" ><img class="circulo" src="{{asset('/img/user/'.$mazo->user->avatar)}}"></a>
               <a href="{{ route('perfil', $mazo->user->id)}}" ><h6 id="nombreUserR">{{ $mazo->user->name }}</h6></a>
            </div>
        </div>
        <div class="datosBasicos">
            <p class="formato">{{ $mazo->formato }}</p>
            <p class="formato"><a href="https://www.cardmarket.com/es/Magic">{{ $mazo->precio }}€</a></p>
        </div>
     

        <div class="grafico">
            <canvas id="myChart" height="80"></canvas>
            <canvas id="doughnut-chart" height="80"></canvas>
        </div>
        <div class="Titulo">
            <h2>Listado de cartas</h2>
        </div>
        <div class="listado">
            <div class="listadoSeparacion">
                @if (sizeof($criaturasLista) > 0)
                    <div>
                        <h2 class="listaT">Criaturas</h2>
                        <ul>
                            @foreach ($criaturasLista as $carta)
                                <li rel="tooltip" data-toggle="tooltip" id="{{ $carta->id }} {{ $carta->tipo }}"
                                    class="liLista" data-trigger="hover" data-placement="right" data-html="true"
                                    data-title="<img class='foto'   src='{{ $carta->foto }}'/>">
                                    {{ str_replace('A-', '', $carta->nombre) }}
                                    @foreach ($cantidad as $cant)
                                        @if ($cant->carta_id == $carta->id)
                                            <span>X </span><span
                                                id="span{{ $carta->id }}">{{ $cant->unidad }}</span>
                                        @endif
                                    @endforeach
                                </li>
                                <span id='carta{{ $carta->id }}' style="display: none">{{ $carta->foto }}</span>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (sizeof($artefactosLista) > 0)
                    <div>
                        <h2 class="listaT">Artefactos</h2>
                        <ul>
                            @foreach ($artefactosLista as $carta)
                                <li rel="tooltip" id="{{ $carta->id }}" class="liLista" data-toggle="tooltip"
                                    data-trigger="hover" data-placement="right" data-html="true"
                                    data-title="<img class='foto' src='{{ $carta->foto }}'/>">
                                    {{ str_replace('A-', '', $carta->nombre) }}
                                    @foreach ($cantidad as $cant)
                                        @if ($cant->carta_id == $carta->id)
                                            <span>X </span> <span
                                                id="span{{ $carta->id }}">{{ $cant->unidad }}</span>
                                        @endif
                                    @endforeach
                                </li>
                                <span id='carta{{ $carta->id }}' style="display: none">{{ $carta->foto }}</span>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="listadoSeparacion">
                @if (sizeof($hechizosLista) > 0)
                    <div>
                        <h2 class="listaT">Hechizos</h2>
                        <ul>
                            @foreach ($hechizosLista as $carta)
                                <li rel="tooltip" data-toggle="tooltip" id="{{ $carta->id }}" class="liLista"
                                    data-trigger="hover" data-placement="right" data-html="true"
                                    data-title="<img class='foto'  src='{{ $carta->foto }}'/>">
                                    {{ str_replace('A-', '', $carta->nombre) }}
                                    @foreach ($cantidad as $cant)
                                        @if ($cant->carta_id == $carta->id)
                                            <span>X </span><span
                                                id="span{{ $carta->id }}">{{ $cant->unidad }}</span>
                                        @endif
                                    @endforeach
                                </li>
                                <span id='carta{{ $carta->id }}' style="display: none">{{ $carta->foto }}</span>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (sizeof($tierrasLista) > 0)
                    <div>
                        <h2 class="listaT">Tierras</h2>
                        <ul>
                            @foreach ($tierrasLista as $carta)
                                <li rel="tooltip" data-toggle="tooltip" id="{{ $carta->id }}" class="liLista"
                                    data-trigger="hover" data-placement="right" data-html="true"
                                    data-title="<img class='foto'   src='{{ $carta->foto }}'/>">
                                    {{ str_replace('A-', '', $carta->nombre) }}
                                    @foreach ($cantidad as $cant)
                                        @if ($cant->carta_id == $carta->id)
                                            <span>X </span> <span
                                                id="span{{ $carta->id }}">{{ $cant->unidad }}</span>
                                        @endif
                                    @endforeach
                                </li>
                                <span id='carta{{ $carta->id }}' style="display: none">{{ $carta->foto }}</span>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <script>
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['0', '1', '2', '3', '4', '5', '6', '7', '+8'],
                    datasets: [{
                        label: 'Curva de maná. Coste Medio ' + {{ $costeTotal }},
                        data: [{{ $coste0 }}, {{ $coste1 }}, {{ $coste2 }},
                            {{ $coste3 }}, {{ $coste4 }}, {{ $coste5 }},
                            {{ $coste6 }}, {{ $coste7 }}, {{ $coste8 }}
                        ],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true
                }
            });

            new Chart(document.getElementById("doughnut-chart"), {
                type: 'doughnut',
                data: {
                    labels: ["Criaturas", "Artefactos", "Hechizos,Instantáneos y Encantamientos", "Tierras"],
                    datasets: [{
                        label: "Tipoos",
                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9"],
                        data: [{{ $criaturas }}, {{ $artefactos }}, {{ $hechizos }},
                            {{ $tierras }}
                        ]
                    }]
                },
                options: {
                    responsive: true
                }
            });
        </script>
            <textarea class="form-control area" readonly>{{ $mazo->descripcion }}</textarea>
        @if (!Auth::guest())
            @if (Auth::id() == $mazo->user->id || Auth::user()->rol() == 'administrador')
                <div class="botones">
                    <button id="editarB" class="crearB">Editar Mazo</button>
                    <form method="POST" action="{{ route('eliminar', $mazo->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="crearB">Eliminar Mazo</button>
                    </form>
                </div>
            @endif
            <div class="corazon">
                <label>Favoritos</label>
                <div>
                <input type="hidden" id="favoritoMazo" value="{{$mazo->id}}">
                <input id="heart" type="checkbox" 
                @foreach (Auth::user()->favoritos as $mazoF)
                    @if ($mazoF->id == $mazo->id)
                        checked
                    @endif
                @endforeach
                />
                <label for="heart">❤</label>
                </div>
            </div>
        @endif
    </div>
    <div id="editar">
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
                                    class="form-control" value="{{$mazo->nombre}}"> <label class="Estado">Formato</label> <select
                                    id="formato" class="form-control">
                                @if ($mazo->formato=="Modern")
                                    <option value="Modern" selected>
                                        Modern
                                    </option>
                                    <option value="Commander">
                                        Commander
                                    </option>
                                @else
                                <option value="Modern">
                                    Modern
                                </option>
                                <option value="Commander" selected>
                                    Commander
                                </option>

                                @endif
                                </select> <label class="Estado">Estado</label>
                                <div class="switch-button">
                                    <input class="switch-button-checkbox" type="checkbox" id="checkEs"> <label
                                        class="switch-button-label" for=""><span
                                            class="switch-button-label-span">Público</span></label>
                                </div>
                            </div>
                            <div class="dvPortada">
                                <label class="Estado">Portada del mazo</label> <img class="portada"
                                    src="{{$mazo->portada}}"
                                    id="portMazo" alt="Image"> <button id="eliminarPortada" class="enviar">Eliminar
                                    portada</button>
                            </div>
                        </div>
                        <div class="totalDiv">
                            <span>Nº de cartas: <span id="total" class="Total">{{$totalUnidad}}</span></span><button class="bt" id="btDes">Descripción</button>
                        </div>
                        <div id="listado" class="listadoCartas"></div>
                        <textarea class="area" id="descripcion"></textarea>
                        <input type="hidden" id="MazoIdetificador" value="{{$mazo->id}}">
                        <div class="fForm">
                            <input type="submit" id="Enviar" value="Guardar" class="enviar">
                        </div>
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
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('js/model.js') }}"></script>
    <script src="{{ asset('js/editar.js') }}"></script>
    <script src="{{ asset('js/nav.js') }}"></script>
    <script src="{{ asset('js/favoritos.js') }}"></script>
</body>

</html>
