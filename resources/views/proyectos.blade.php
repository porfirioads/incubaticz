@extends('layouts.dashboard')
@section('page_heading','Proyectos registrados')

@section('section')
    <div class="row">
        <div class="col-sm-12">
            <table class="table">
                <thead>
                <tr>
                    <th>Nombre del proyecto</th>
                    <th>Encargado</th>
                    <th>Documentos</th>
                </tr>
                </thead>
                <tbody>
                @foreach($proyectos as $proyecto)
                    <tr>
                        <td>{{$proyecto->titulo}}</td>
                        <td>{{$proyecto->nombre }} {{$proyecto->pri_apellido}}
                            ({{$proyecto->email}})
                        </td>
                        <td>
                            <a class="btn btn-primary btnProjectFiles"
                               href="{{URL('/proyectos/' .
                               $proyecto->proyecto_id)}}">
                                <span class="fa fa-download"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop