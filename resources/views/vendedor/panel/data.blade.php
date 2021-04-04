@extends('vendedor.layouts.app')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Mi cuenta</h3>
    </div>  
</div>



              <div class="col-md-12 col-sm-12 ">
<div class="x_panel">
                  <div class="x_title">
                    <h2>Mi perfil </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>

                    <form class="form-label-left input_mask"  method="post" 
                          action="/partner/my-account/edit"
                          >
                          @method('POST')
                          @csrf

                      <div class="col-md-6 col-sm-6  form-group has-feedback">
                        <input value="{{$user->name}}" type="text" class="form-control has-feedback-left" 
                            id="inputSuccess2" placeholder="nombre" name="nombre">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6  form-group has-feedback">
                        <input type="text" value="{{$user->apellido_paterno }}" class="form-control" id="inputSuccess3" placeholder="Apellido Paterno" name="appelido_p">
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6  form-group has-feedback">
                        <input type="text" value="{{$user->email }}" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Email" name="email">
                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6  form-group has-feedback">
                        <input type="text" value="{{$user->telefono }}" class="form-control" id="inputSuccess5" placeholder="Telefono" name="tel">
                        <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Fecha de nacimiento</label>
                        <div class="col-md-9 col-sm-9 ">
                          <input type="date" class="form-control" placeholder="Fecha de nacimiento" value="{{$user->fecha_nacimiento }}" name="fecha">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Dirección</label>
                        <div class="col-md-9 col-sm-9 ">
                          <input type="text" class="form-control" placeholder="Dirección" value="{{$user->direccion }}" name="dir">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">C.P.</label>
                        <div class="col-md-9 col-sm-9 ">
                          <input type="text" class="form-control" placeholder="C.P." value="{{$user->cp }}" name="cp">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Ciudad</label>
                        <div class="col-md-9 col-sm-9 ">
                          <input type="text" class="form-control" placeholder="Ciudad" value="{{$user->ciudad }}" name="ciudad">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">País</label>
                        <div class="col-md-9 col-sm-9 ">
                          <input type="text" class="form-control" placeholder="País" value="{{$user->pais }}" name="pais">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Tarjeta</label>
                        <div class="col-md-9 col-sm-9 ">
                          <input type="text" class="form-control" placeholder="" value="{{$user->tarjeta }}" name="tarjeta">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Estado de mi cuenta</label>
                        <div class="col-md-9 col-sm-9 ">
                           @if($user->estado == 0)
                          <a  class="btn btn-round btn-danger" style="color:white;">en revisión</a>
                          @else
                            <a  class="btn btn-round btn-success" style="color:white;">autorizada</a>
                          @endif
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group row">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                          <button type="submit" class="btn btn-success">Actualizar Información</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>



              <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Estado y niveles de mi cuenta</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="col-md-12 col-sm-12">

                      <ul class="stats-overview">
                        {{-- <li>
                          <h4>Estado de mi cuenta</h4>
                          @if($user->estado == 0)
                          <button type="text" class="btn btn-round btn-danger">en revisión</button>
                          @else
                            <button type="text" class="btn btn-round btn-success">autorizada</button>
                          @endif
                        </li> --}}
                        <li>
                          <h4>Ventas en línea</h4>
                          <span class="name"> nivel de comisión ({{$user->nivel_linea }}) </span>
                          <span class="value text-success"> % {{$user->comision_linea * 100 }} por boleto</span>
                        </li>
                        <li>
                          <h4>Ventas por compra</h4>
                          <span class="name"> nivel de comisión ({{$user->nivel_compra }}) </span>
                          <span class="value text-success"> % {{$user->comision_compra * 100 }} por boleto</span>
                        </li>
                        <li>
                          <h4>Más información</h4>
                          <a class="btn btn-app" href="/partner/info-earn">
                            <i class="fa fa-question"></i>Más información
                          </a>
                          {{-- <a href="">Más información</a> --}}
                        </li>
                      </ul>
                      <br>

                      


                    </div>


                  </div>
                </div>
              </div>
            </div>





              </div>


@endsection