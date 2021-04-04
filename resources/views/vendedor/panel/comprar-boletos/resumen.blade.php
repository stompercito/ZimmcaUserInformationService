@extends('vendedor.layouts.app')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Resumen de compra</h3>
    </div>  
</div>

<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Descripción de boletos</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                              <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Rifa</th>
                          <th>Número Boleto</th>
                          <th>Precio venta </th>
                          <th>Precio compra nivel ({{ $usuario->nivel_compra }}) </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $index = 1;
                        ?>
                          @foreach($arrBoletos as $producto)
                                    <tr>
                                        <th scope="row">{{ $index }}</th>
                                        <td>{{ $producto->post_title }}</td>
                                        <td><i class='fa fa-ticket' aria-hidden='true'></i> {{ $producto->numero  }}</td>
                                        <td>$ {{ $producto->meta_value }} </td>
                                        <td>$ {{ ($producto->meta_value - ($producto->meta_value * $usuario->comision_compra))  }}</td>
                                    </tr>
                                     <?php 
                                     $index++; 
                                     $precio_venta = ($producto->meta_value - ($producto->meta_value * $usuario->comision_compra));
                                     ?>
                                     <input type="number" id="productoID" value="{{ $producto->ID }}" hidden>
                          @endforeach
                          <tr>
                            <td colspan="3"></td>
                            <td><b>Total:</b></td>
                            <td>  <b>$ <?php echo  ($precio_venta * ($index - 1)); ?></b></td>
                          </tr>
                    </table>

            </div>
        </div>
    </div>
</div>


<div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Número de tarjeta para realizar el deposito con el total de la compra </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"><b>Número de tarjeta: </b><span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input value="4152 3134 6586 2691" type="text" class="form-control " readonly>
                        </div>
                      </div>
                      
                    </form>
                  </div>
                </div>
              </div>
            </div>


<div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Información de Déposito</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form id="demo-form2" data-parsley-validate="" 
                          class="form-horizontal form-label-left" novalidate=""
                          method="post" 
                          enctype="multipart/form-data"
                          action="/partner/buy-tickets/save"
                          >
                          @method('POST')
                          @csrf
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input value="{{ Auth::user()->name }}" type="text" id="nombre" name="nombre" required="required" class="form-control " readonly>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Código Socio<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input value="{{ Auth::user()->id }}" type="text" id="id_socio" name="id_socio" required="required" class="form-control " readonly>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Fecha del depósito<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="date" id="fecha_deposito" name="fecha_deposito" required="required" class="form-control">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Cantidad depositada<span class="required">* $</span></label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="cantidad" class="form-control" type="number" name="cantidad">
                          <span>(Pesos)</span>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Ciudad en donde hiciste el déposito<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                        <input id="ciudad" class="form-control" type="text" name="ciudad">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Adjunta una foto de tu recibo de pago el déposito<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="recibo" name="recibo" class="form-control" type="file" name="middle-name">
                        </div>
                      </div>
                      <input type="text" name="boletos" id="boletos" value="{{$boletos_string}}" hidden>
                      <input type="number" name="total_compra" id="total_compra" value="<?php echo ($precio_venta * ($index - 1)); ?>" hidden>
                      <input type="number" name="cantidad_boletos" id="cantidad_boletos" value="{{($index - 1)}}" hidden>
                      <input type="number" name="precio_boleto" id="precio_boleto" value="{{$precio_venta}}" hidden>
                      <input type="number" name="producto_id" id="producto_id" hidden>

                      <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                          <button type="submit" class="btn btn-success">Enviar</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>


<script type="application/javascript">

let prod = document.getElementById('productoID').value;
console.log(prod)
document.getElementById('producto_id').value = prod;

</script>

@endsection
