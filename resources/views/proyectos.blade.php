@extends('layouts.dashboard')
@section('page_heading','Tables')

@section('section')
    <div class="row">
        <div class="col-sm-12">
            <table class="table">
                <thead>
                <tr>
                    <th>Nombre del proyecto</th>
                    <th>Documentos</th>
                </tr>
                </thead>
                <tbody>
                @foreach($proyectos as $proyecto)
                    <tr>
                        <td>{{$proyecto->titulo}}</td>
                        <td>
                            <a class="btn btn-primary btnProjectFiles"
                               href="{{URL('/proyectos/' . $proyecto->id)}}">
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