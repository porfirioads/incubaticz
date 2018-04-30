@extends ('layouts.dashboard')
@section('page_heading', 'Registro')

@section('section')

    <div class="row">
        <div class="col-lg-12">
            <form role="form">

                @section ('dpanel_panel_title', 'Datos de los integrantes')

                @section ('dpanel_panel_body')
                    <h4>Integrante 1</h4>
                    <hr>

                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Primer apellido:</label>
                                <input type="text"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Segundo apellido:</label>
                                <input type="text"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Fecha de nacimiento:</label>
                                <input type="text"
                                       class="form-control datepicker">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-2 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Nivel de estudios:</label>
                                <select class="form-control">
                                    <option>Por egresar</option>
                                    <option>Licenciatura</option>
                                    <option>Posgrado</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-5 col-md-8 col-sm-12">
                            <div class="form-group">
                                <label>Carrera o posgrado:</label>
                                <input type="text"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-5 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Universidad:</label>
                                <input type="text"
                                       class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Título profesional:</label>
                                <input type="file">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Constancia de
                                    estudios:</label>
                                <input type="file">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Constancia de obligaciones
                                    académicas:</label>
                                <input type="file">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>INE:</label>
                                <input type="file">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>CURP:</label>
                                <input type="file">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Oficio de protesta de decir
                                    verdad:</label>
                                <input type="file">
                            </div>
                        </div>
                    </div>
                @endsection

                @include ('widgets.panel', array('class'=>'default', 'header'=>true,
                'as'=>'dpanel'))

                @section ('dpanel2_panel_title', 'Datos del proyecto')

                @section ('dpanel2_panel_body')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Responsable del
                                    proyecto:</label>
                                <select class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Anteproyecto (20
                                    cuartillas):</label>
                                <input type="file">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txtNombreProyecto">Nombre del proyecto
                            (250 palabras):</label>
                        <input id="txtNombreProyecto" name="txtNombreProyecto"
                               class="form-control txtWithWordCounter"
                               data-max_words="250">
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
                @endsection

                @include ('widgets.panel', array('class'=>'default', 'header'=>true,
                'as'=>'dpanel2'))

                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
                <button type="reset" class="btn btn-danger">
                    Cancelar
                </button>

                <br/>
                <br/>
            </form>
        </div>
    </div>
@stop