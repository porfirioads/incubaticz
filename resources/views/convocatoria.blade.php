@extends ('layouts.dashboard')

@section ('page_heading', 'Convocatoria')

@section('section')

@section ('dpanel_panel_title', 'Documentos')

@section ('dpanel_panel_body')
    <div class="list-group">
        <a href="{{URL::to('assets/res/Convocatoria INCUBATICZ 2018.pdf')}}"
           class="list-group-item" target="_blank">
            Convocatoria
        </a>
        <a href="{{URL::to('assets/res/Términos de referencia INCUBATICZ 2018.pdf')}}"
           class="list-group-item" target="_blank">
            Términos de Referencia
        </a>
        <a href="{{URL::to('assets/res/Ficha técnica INCUBATICZ.pdf')}}"
           class="list-group-item" target="_blank">
            Ficha Técnica
        </a>
    </div>
@endsection

@include ('widgets.panel', array('class'=>'default', 'header'=>true,
'as'=>'dpanel'))


@stop

