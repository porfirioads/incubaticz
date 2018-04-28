@extends('layouts.dashboard')
@section('page_heading','INCUBATICZ')

@section('section')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-8">
                @section ('pane2_panel_title', 'Ficha Técnica INCUBATICZ')
                @section ('pane2_panel_body')
                    <ul class="timeline">
                        <li>
                            <div class="timeline-badge"><i
                                        class="fa fa-check"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">
                                        Convocatoria
                                    </h4>
                                </div>
                                <div class="timeline-body">
                                    <p>
                                        Programa de apoyo para la incubación de
                                        empresas de tecnologías de información y
                                        comunicación (INCUBATICZ)
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-badge warning"><i
                                        class="fa fa-check"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">
                                        Objetivo
                                    </h4>
                                </div>
                                <div class="timeline-body">
                                    <p>
                                        Apoyar a jóvenes emprendedores que estén
                                        cursando el último año de su programa de
                                        estudio y/o aquellos que tengan por lo
                                        menos un año de egresados de las
                                        carreras con base científica y
                                        tecnológica; en la creación y
                                        consolidación de empresas de base
                                        tecnológica, mediante un apoyo económico
                                        y un proceso de incubación, asesorados
                                        por empresarios exitosos que impulsarán
                                        el desarrollo de la empresa incubada.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge danger"><i
                                        class="fa fa-check"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">
                                        Dirigido a:
                                    </h4>
                                </div>
                                <div class="timeline-body">
                                    <p>
                                        Equipo integrado por 3 jóvenes
                                        emprendedores que tengan máximo un año
                                        de haber egresado de los planes de
                                        estudio de las Instituciones de
                                        Educación Superior del Estado de
                                        Zacatecas<sup>1</sup>, de áreas de
                                        Tecnologías de
                                        la Información y afines<sup>2</sup>.
                                    </p>
                                    <p>
                                        Empresas legalmente establecidas en el
                                        Estado de Zacatecas, que quieran formar
                                        una sociedad con jóvenes
                                        emprendedores(as) y contribuir al
                                        emprendimiento tecnológico mediante la
                                        formación de una nueva empresa de base
                                        tecnológica y la capacitación de los
                                        jóvenes participantes.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">
                                        Áreas de conocimiento que se apoyarán
                                    </h4>
                                </div>
                                <div class="timeline-body">
                                    <ul>
                                        <li>
                                            Aplicaciones para dispositivos
                                            móviles.
                                        </li>
                                        <li>
                                            Herramientas de productividad.
                                        </li>
                                        <li>
                                            Proyectos ligados a desarrollo de
                                            prototipos de
                                            hardware/electrónica/micro y nano
                                            circuitos. Soluciones basadas en
                                            Movilidad (B2B, B2C, C2C).
                                        </li>
                                        <li>
                                            Robótica y nano robótica.
                                        </li>
                                        <li>
                                            Bioinformática.
                                        </li>
                                        <li>
                                            Música digital.
                                        </li>
                                        <li>
                                            Sistemas que solucionen problemas
                                            en: minería, agroindustria,
                                            biotecnología, energías
                                            renovables, medio ambiente,
                                            industria automotriz, metalmecánica.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge info"><i
                                        class="fa fa-check"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">
                                        Fechas de vigencia de Convocatoria
                                    </h4>
                                </div>
                                <div class="timeline-body">
                                    <p>
                                        Del 25 de abril al 23 de mayo de 2018
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-badge success"><i
                                        class="fa fa-check"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">
                                        Periodo de operación
                                    </h4>
                                </div>
                                <div class="timeline-body">
                                    <p>
                                        Del 1 de junio al 31 de diciembre de
                                        2018
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'pane2'))
            </div>
            <div class="col-lg-4">
                @section ('pane1_panel_title', 'Notas')
                @section ('pane1_panel_body')
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <sup>1</sup> También podrán participar jóvenes que
                            estén inscritos en el último año de sus programas de
                            estudios, siempre y cuando tengan disponibilidad de
                            tiempo.
                        </a>
                        <a href="#" class="list-group-item">
                            <sup>2</sup> Podrán participar jóvenes de las
                            carreras de mecatrónica, electrónica, marketing,
                            negocios (en un esquema de equipo de trabajo
                            complementario), entre otras.
                        </a>
                    </div>
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'pane1'))
            </div>
        </div>
    </div>
@stop
