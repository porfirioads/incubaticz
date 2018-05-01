@extends ('layouts.plane')
@section ('body')
    <div class="modal fade" id="modalFalloLogin" tabindex="-1"
         role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-danger">
                <div class="modal-header modal-header-danger">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Error al iniciar sesión
                    </h5>
                </div>
                <div class="modal-body">
                    Usuario o contraseña incorrectos
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

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <br/><br/><br/>
                @section ('login_panel_title','Please Sign In')
                @section ('login_panel_body')
                    <form role="form" action="{{URL('/login')}}"
                          method="POST"
                          enctype="multipart/form-data"
                          id="formLogin">
                        <input type="hidden" name="_token"
                               value="{{ csrf_token() }}">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control"
                                       placeholder="Username"
                                       name="username" type="text"
                                       autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control"
                                       placeholder="Password" name="password"
                                       type="password" value="">
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Ingresar
                            </button>
                        </fieldset>
                    </form>

                @endsection
                @include('widgets.panel', array('as'=>'login', 'header'=>true))
            </div>
        </div>
    </div>
@stop