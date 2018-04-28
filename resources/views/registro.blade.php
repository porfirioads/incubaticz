@extends ('layouts.dashboard')
@section('page_heading', 'Registro')

@section('section')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-12">
                <form role="form">
                    <h2>Datos de los integrantes</h2>

                    <h3>Integrante 1</h3>

                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Primer apellido:</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Segundo apellido:</label>
                                <input type="text" class="form-control">
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
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-5 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Universidad:</label>
                                <input type="text" class="form-control">
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
                                <label>Constancia de estudios:</label>
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

                    <h2>Datos del proyecto</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Responsable del proyecto:</label>
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
                                <label>Anteproyecto (20 cuartillas):</label>
                                <input type="file">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nombre del proyecto (250 palabras):</label>
                        <input class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Descripción (250 palabras):</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Impacto social (250 palabras):</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Análisis de factibilidad del proyecto (500
                            palabras):</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Cronograma de actividades (250 palabras):</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Metodología (500 palabras):</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Resultados esperados (500 palabras):</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Plan de negocios (500 palabras):</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>

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
    </div>
@stop