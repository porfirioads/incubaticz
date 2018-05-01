@extends('layouts.plane')

@section('body')
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation"
             style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle"
                        data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url ('') }}">INCUBATICZ</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        @if (Session::get('adminLogged'))
                            <li>
                                <a href="{{ url ('logout') }}">
                                    <i class="fa fa-sign-out fa-fw"></i>
                                    Cerrar sesión
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ url ('login') }}">
                                    <i class="fa fa-sign-in fa-fw"></i>
                                    Iniciar sesión
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li {{ (Request::is('/') ? 'class="active"' : '') }}>
                            <a href="{{ url ('') }}"><i class="fa
                            fa-info fa-fw"></i> Ficha Técnica</a>
                        </li>
                        <li {{ (Request::is('*convocatoria') ? 'class="active"' : '')}}>
                            <a href="{{ url ('convocatoria') }}"><i
                                        class="fa fa-book fa-fw"></i>
                                Convocatoria</a>
                        </li>
                        <li {{ (Request::is('*registro') ? 'class="active"' :
                         '') }}>
                            <a href="{{ url ('registro') }}"><i
                                        class="fa fa-sign-in fa-fw"></i>
                                Registro</a>
                        </li>
                        <li {{ (Request::is('*convocatoria') ? 'class="active"' : '')}}>
                            <a href="{{ url ('convocatoria') }}"><i
                                        class="fa fa-book fa-fw"></i>
                                Convocatoria</a>
                        </li>
                        @if (Session::get('adminLogged'))
                            <li {{ (Request::is('*proyectos') ? 'class="active"' :'')}}>
                                <a href="{{ url ('proyectos') }}"><i
                                            class="fa fa-list-ul fa-fw"></i>
                                    Proyectos</a>
                            </li>
                        @endif
                        <li {{ (Request::is('*tables') ? 'class="active"' : '') }}>
                            <a href="{{ url ('tables') }}"><i
                                        class="fa fa-table fa-fw"></i>
                                Tables</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i>
                                Sample Pages<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*blank') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('blank') }}">Blank Page</a>
                                </li>
                                <li>
                                    <a href="{{ url ('login') }}">Login Page</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('page_heading')</h1>
                </div>
            </div>
            <div class="row">
                @yield('section')

            </div>
        </div>
    </div>
@stop

