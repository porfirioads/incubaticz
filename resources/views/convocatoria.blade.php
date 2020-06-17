@extends ('layouts.dashboard')

@section ('page_heading', 'Convocatoria')

@section('section')

@section ('dpanel_panel_title', 'Documentos')

@section ('dpanel_panel_body')
    <div class="list-group">
        <a href="{{ url ('convocatoria_download') }}"
           class="list-group-item" target="_blank">
            Convocatoria
        </a>
        <a href="{{ url ('terminos_referencia_download') }}"
           class="list-group-item" target="_blank">
            Términos de Referencia
        </a>
        <a href="{{ url ('ficha_tecnica_download') }}"
           class="list-group-item" target="_blank">
            Ficha Técnica
        </a>
    </div>
@endsection

@include ('widgets.panel', array('class'=>'default', 'header'=>true,
'as'=>'dpanel'))


@stop

