@extends ('layouts.dashboard')
@section('page_heading', 'Registro')

@section('section')
    <div class="modal fade" id="modalExitoRegistro" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal
                        title</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    El proyecto fue registrado con éxito
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                            data-dismiss="modal">
                        Aceptar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalFalloRegistro" tabindex="-1"
         role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-danger">
                <div class="modal-header modal-header-danger">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Error al registrar proyecto
                    </h5>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                            data-dismiss="modal">
                        Aceptar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
        <!--
            <form id="formRegistroProyecto"
                  role="form" action="{{URL('/registro')}}"
                  enctype="multipart/form-data" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                -->

            @section ('dpanel_panel_title', 'Datos de los integrantes')

            @section ('dpanel_panel_body')

                <div class="form-group">
                    <label for="selIntegrantes">Cantidad de
                        integrantes:</label>
                    <select id="selIntegrantes" name="selIntegrantes"
                            class="form-control">
                        <option selected="selected" disabled="disabled"
                                value="0"></option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

                <p>
                    <strong>Nota: </strong> El 1er integrante registrado se
                    asignará como el responsable del proyecto
                </p>

                <div id="integrantesContainer"></div>

                <div id="integranteTemplate" class="hidden">
                    <form
                          role="form" action="{{URL('/registro_integrante')}}"
                          enctype="multipart/form-data" method="POST">

                        <input type="hidden" name="_token"
                               value="{{ csrf_token() }}">

                        <input type="hidden" name="numIntegrante"
                               class="numIntegrante">

                        <input type="hidden" name="proyectoId"
                               class="proyectoId">

                        <h4 class="integranteLabel"></h4>
                        <hr>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Nombre:</label>
                                    <input type="text"
                                           class="form-control"
                                           id="nombreIntegrante"
                                           name="nombreIntegrante">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Primer apellido:</label>
                                    <input type="text"
                                           class="form-control"
                                           id="priApellido" name="priApellido">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Segundo apellido:</label>
                                    <input type="text"
                                           class="form-control"
                                           id="segApellido" name="segApellido">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="email"
                                           class="form-control"
                                           id="email" name="email">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Fecha de nacimiento:</label>
                                    <input type="text"
                                           class="form-control datepicker"
                                           id="fechaNacimiento"
                                           name="fechaNacimiento">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Nivel de estudios:</label>
                                    <select class="form-control"
                                            id="nivelEstudios"
                                            name="nivelEstudios">
                                        <option selected="selected"
                                                disabled="disabled"
                                                value="0"></option>
                                        <option value="Por egresar">
                                            Por egresar
                                        </option>
                                        <option value="Licenciatura">
                                            Licenciatura
                                        </option>
                                        <option value="Posgrado">
                                            Posgrado
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-5 col-md-8 col-sm-12">
                                <div class="form-group">
                                    <label>Carrera o posgrado:</label>
                                    <input type="text"
                                           class="form-control"
                                           id="carrera" name="carrera">
                                </div>
                            </div>

                            <div class="col-lg-5 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Universidad:</label>
                                    <input type="text"
                                           class="form-control"
                                           id="universidad" name="universidad">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Título profesional:</label>
                                    <input type="file"
                                           id="titulo" name="titulo">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Constancia de estudios:</label>
                                    <input type="file"
                                           id="constanciaEstudios"
                                           name="constanciaEstudios">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Constancia de obligaciones
                                        académicas:</label>
                                    <input type="file"
                                           id="constanciaObligaciones"
                                           name="constanciaObligaciones">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>INE:</label>
                                    <input type="file"
                                           id="ine" name="ine">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>CURP:</label>
                                    <input type="file"
                                           id="curp" name="curp">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Oficio de protesta de decir
                                        verdad:</label>
                                    <input type="file"
                                           id="oficioProtesta"
                                           name="oficioProtesta">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>RFC:</label>
                                    <input type="file"
                                           id="rfc" name="rfc">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>
                                        Carta de opinión positiva del SAT:
                                    </label>
                                    <input type="file"
                                           id="cartaSat" name="cartaSat">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="hidden"></button>
                    </form>
                </div>

            <!--
                <div id="integranteTemplate" class="hidden">
                    <form class="formIntegranteProyecto"
                          role="form" action="{{URL('/registro_integrante')}}"
                          enctype="multipart/form-data" method="POST">

                        <input type="hidden" name="_token"
                               value="{{ csrf_token() }}">

                        <input type="hidden" id="numIntegrante"
                               name="numIntegrante">

                        <input type="hidden" id="proyectoId"
                               name="proyectoId">

                        <h4 class="numIntegrante"></h4>
                        <hr>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group nombreIntegrante">
                                    <label>Nombre:</label>
                                    <input type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group priApellido">
                                    <label>Primer apellido:</label>
                                    <input type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group segApellido">
                                    <label>Segundo apellido:</label>
                                    <input type="text"
                                           class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group email">
                                    <label>Email:</label>
                                    <input type="email"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group fechaNacimiento">
                                    <label>Fecha de nacimiento:</label>
                                    <input type="text"
                                           class="form-control datepicker">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2 col-md-4 col-sm-12">
                                <div class="form-group nivelEstudios">
                                    <label>Nivel de estudios:</label>
                                    <select class="form-control">
                                        <option selected="selected"
                                                disabled="disabled"
                                                value="0"></option>
                                        <option value="Por egresar">
                                            Por egresar
                                        </option>
                                        <option value="Licenciatura">
                                            Licenciatura
                                        </option>
                                        <option value="Posgrado">
                                            Posgrado
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-5 col-md-8 col-sm-12">
                                <div class="form-group carrera">
                                    <label>Carrera o posgrado:</label>
                                    <input type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-5 col-md-12 col-sm-12">
                                <div class="form-group universidad">
                                    <label>Universidad:</label>
                                    <input type="text"
                                           class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group titulo">
                                    <label>Título profesional:</label>
                                    <input type="file">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group constanciaEstudios">
                                    <label>Constancia de estudios:</label>
                                    <input type="file">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group constanciaObligaciones">
                                    <label>Constancia de obligaciones
                                        académicas:</label>
                                    <input type="file">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group ine">
                                    <label>INE:</label>
                                    <input type="file">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group curp">
                                    <label>CURP:</label>
                                    <input type="file">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group oficioProtesta">
                                    <label>Oficio de protesta de decir
                                        verdad:</label>
                                    <input type="file">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group rfc">
                                    <label>RFC:</label>
                                    <input type="file">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group cartaSat">
                                    <label>
                                        Carta de opinión positiva del SAT:
                                    </label>
                                    <input type="file">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                -->
            @endsection

            @include ('widgets.panel', array('class'=>'default', 'header'=>true,
            'as'=>'dpanel'))

            @section ('dpanel2_panel_title', 'Datos del proyecto')

            @section ('dpanel2_panel_body')
                <form id="formRegistroProyecto"
                      role="form" action="{{URL('/registro')}}"
                      enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="_token"
                           value="{{ csrf_token() }}">

                    <input type="hidden" id="numIntegrantes"
                           name="numIntegrantes">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Anteproyecto (20 cuartillas):</label>
                                <input id="anteproyecto" name="anteproyecto"
                                       type="file">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txtNombreProyecto">Nombre del proyecto
                            (250 palabras):</label>
                        <input id="txtNombreProyecto" name="txtNombreProyecto"
                               class="form-control txtWithWordCounter"
                               data-max_words="250"
                               value="{{old('txtNombreProyecto')}}">
                    </div>

                    <div class="form-group">
                        <label for="txtDescripcion">Descripción
                            (250 palabras):</label>
                        <textarea id="txtDescripcion" name="txtDescripcion"
                                  class="form-control txtWithWordCounter"
                                  rows="3" data-max_words="250"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="txtImpactoSocial">Impacto social
                            (250 palabras):</label>
                        <textarea id="txtImpactoSocial" name="txtImpactoSocial"
                                  class="form-control txtWithWordCounter"
                                  rows="3" data-max_words="250"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="txtFactibilidad">
                            Análisis de factibilidad del proyecto
                            (500 palabras):
                        </label>
                        <textarea id="txtFactibilidad" name="txtFactibilidad"
                                  class="form-control txtWithWordCounter"
                                  rows="3" data-max_words="500"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="txtCronograma">Cronograma de actividades
                            (250 palabras):</label>
                        <textarea id="txtCronograma" name="txtCronograma"
                                  class="form-control txtWithWordCounter"
                                  rows="3" data-max_words="250"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="txtMetodologia">
                            Metodología (500 palabras):
                        </label>
                        <textarea id="txtMetodologia" name="txtMetodologia"
                                  class="form-control txtWithWordCounter"
                                  rows="3" data-max_words="500"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="txtResultados">
                            Resultados esperados (500 palabras):
                        </label>
                        <textarea id="txtResultados" name="txtResultados"
                                  class="form-control txtWithWordCounter"
                                  rows="3" data-max_words="500"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="txtPlanNegocios">Plan de negocios
                            (500 palabras):</label>
                        <textarea id="txtPlanNegocios" name="txtPlanNegocios"
                                  class="form-control txtWithWordCounter"
                                  rows="3" data-max_words="500"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                </form>
            @endsection

            @include ('widgets.panel', array('class'=>'default', 'header'=>true,
            'as'=>'dpanel2'))

            <br/>
            <br/>
            <!-- </form> -->

        </div>
    </div>
@stop
