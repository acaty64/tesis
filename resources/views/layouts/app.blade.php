<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UCSS') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a href="http://www.ucss.edu.pe" target="_blank">
                        <img class="navbar-brand" src="{{asset('images/logo-ucss.png')}}" ></img></a>
                    <p>{{ env('SEMESTRE') }}</p>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-left">
                    @guest
                    @else
{{--                         <li class="dropdown consulta">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>Consulta</a>
                            <ul class="dropdown-menu">
                                <li><a class="xCurso" href="{{ route('cursos.index') }}">Por curso</a></li>
                                <li><a class="malla" href="{{ route('malla', ['adm']) }}">En malla curricular</a></li>
                            </ul>
                        </li>
                        <li class="dropdown edicion">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>Edición</a>
                            <ul class="dropdown-menu">
                                @if(Auth::user()->acceso->cod_acceso == 'master' || Auth::user()->acceso->cod_acceso == 'adm')
                                    <li><a class="xGrupo" href="{{ route('grupos.index', ['show']) }}">Por Grupo Temático</a></li>
                                @endif
                                @if(Auth::user()->acceso->cod_acceso == 'resp')
                                    <li><a class="xGrupo" href="{{ route('cursogrupo.index', [Auth::user()->grupo->cod_grupo]) }}">Grupo Temático</a></li>
                                @endif
                            </ul>
                        </li> --}}
                        @if(Auth::user()->tuser == 'Master')
                         {{-- || Auth::user()->acceso->cod_acceso == 'adm') --}}
                            <li class="dropdown comunicacion">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>Comunicación</a>
                                <ul class="dropdown-menu">
                                    <li><a class="comunicados" href="">Comunicados</a></li>
                                    <li><a class="preview" href="">Vista Previa</a></li>
                                </ul>
                            </li>
                            <li class="dropdown mantenimiento">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>Mantenimiento</a>
                                <ul class="dropdown-menu">
                                    <li><a class="download" href="">Descarga de Archivos</a></li>
                                    <li><a class="usuarios" href="">Usuarios</a></li>
                                    <li><a class="index_semestre" href="{{ route('semestre.index') }}">Nuevo Semestre</a></li>
                                    <li><a class="accesos" href="/enConstruccion">Accesos</a></li>
                                    <li><a class="grupos" href="/enConstruccion">Grupos</a></li>
                                    <li><a class="cursos" href="/enConstruccion">Cursos</a></li>
                                </ul>
                            </li>
                        @endif
                        @if(Auth::user()->tuser == 'Master')
                            <li><a class="backup" href="">Backup & Restore</a></li>
                        @endif
                        <li><a href="{{ URL::previous() }}">Anterior</a></li>
                    @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <!--li><a href="{{ route('register') }}">Register</a></li-->
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }}  <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            @include('flash::message')
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('jquery')
    @yield('js')
    
    <!-- Style -->
    @yield('style')

    <!-- Footer -->
    @include('layouts.partials.footer')

</body>
</html>

