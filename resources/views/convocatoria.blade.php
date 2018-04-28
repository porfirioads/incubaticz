@extends ('layouts.dashboard')

@section ('page_heading', 'Convocatoria')

@section('section')

@section ('dpanel_panel_title', 'Documentos')

@section ('dpanel_panel_body')
    <div class="list-group">
        <a href="{{URL::to('assets/res/Convocatoria_2018 VF.doc')}}"
           class="list-group-item">
            Convocatoria
        </a>
        <a href="{{URL::to('assets/res/Términos de referencia INCUBATICS.docx')}}"
           class="list-group-item">
            Términos de Referencia
        </a>
        <a href="{{URL::to('assets/res/Ficha técnica INCUBATIC.docx')}}"
           class="list-group-item">
            Ficha Técnica
        </a>
    </div>
@endsection

@include ('widgets.panel', array('class'=>'default', 'header'=>true,
'as'=>'dpanel'))


@stop

