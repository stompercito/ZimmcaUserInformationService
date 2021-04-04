@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Usuario {{ $usuario->id }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif                    

                <div class="card-body">

                	<form>
					  <div class="form-group">
					    <label>ID</label>
					    <input type="number" class="form-control" id="ID" value="{{ $usuario->id }}">
					  </div>
					  <div class="form-group">
					    <label>name</label>
					    <input type="text" class="form-control" id="name" value="{{ $usuario->name }}">
					  </div>
					  <div class="form-group">
					    <label>email</label>
					    <input type="text" class="form-control" id="email" value="{{ $usuario->email }}">
					  </div>
					  <div class="form-group">
					    <label>apellido_paterno</label>
					    <input type="text" class="form-control" id="apellido_paterno" value="{{ $usuario->apellido_paterno }}">
					  </div>
					  <div class="form-group">
					    <label>apellido_materno</label>
					    <input type="text" class="form-control" id="apellido_materno" value="{{ $usuario->apellido_materno }}">
					  </div>
					  <div class="form-group">
					    <label>sexo</label>
					    <input type="text" class="form-control" id="sexo" value="{{ $usuario->sexo }}">
					  </div>
					  <div class="form-group">
					    <label>fecha_nacimiento</label>
					    <input type="text" class="form-control" id="fecha_nacimiento" value="{{ $usuario->fecha_nacimiento }}">
					  </div>
					  <div class="form-group">
					    <label>direccion</label>
					    <input type="text" class="form-control" id="direccion" value="{{ $usuario->direccion }}">
					  </div>
					  <div class="form-group">
					    <label>cp</label>
					    <input type="text" class="form-control" id="cp" value="{{ $usuario->cp }}">
					  </div>
					  <div class="form-group">
					    <label>entidad</label>
					    <input type="text" class="form-control" id="entidad" value="{{ $usuario->entidad }}">
					  </div>
					  <div class="form-group">
					    <label>ciudad</label>
					    <input type="text" class="form-control" id="ciudad" value="{{ $usuario->ciudad }}">
					  </div>
					  <div class="form-group">
					    <label>telefono</label>
					    <input type="text" class="form-control" id="telefono" value="{{ $usuario->telefono }}">
					  </div>
					  <div class="form-group">
					    <label>pais</label>
					    <input type="text" class="form-control" id="pais" value="{{ $usuario->pais }}">
					  </div>
					  <div class="form-group">
					    <label>url</label>
					    <input type="text" class="form-control" id="url" value="{{ $usuario->url }}">
					  </div>
					  <div class="form-group">
					    <label>estado</label>
					    <input type="text" class="form-control" id="estado" value="{{ $usuario->estado }}">
					  </div>
					  <div class="form-group">
					    <label>comision_linea</label>
					    <input type="text" class="form-control" id="comision_linea" value="{{ $usuario->comision_linea }}">
					  </div>
					  <div class="form-group">
					    <label>comision_compra</label>
					    <input type="text" class="form-control" id="comision_compra" value="{{ $usuario->comision_compra }}">
					  </div>
					  <div class="form-group">
					    <label>nivel_linea</label>
					    <input type="text" class="form-control" id="nivel_linea" value="{{ $usuario->nivel_linea }}">
					  </div>
					  <div class="form-group">
					    <label>nivel_compra</label>
					    <input type="text" class="form-control" id="nivel_compra" value="{{ $usuario->nivel_compra }}">
					  </div>

					  <a href="/generar-url/{{$usuario->id}}" id="generar_url" class="btn btn-primary">Generar URL</a>
					  <br>
					  <br>
					  <a href="/cambiar-estado/{{$usuario->id}}" class="btn btn-primary">Cambiar Estado</a>
					  <a href="/desactivar-usuario/{{$usuario->id}}" class="btn btn-primary">Desactivar Usuario</a>
					  <br>
					  <br>
					  <a href="/cambiar-nivel-linea/{{$usuario->id}}" class="btn btn-primary">Cambiar Nivel Comisión (linea)</a>
					  <br>
					  <br>
					  <a href="/cambiar-nivel-compra/{{$usuario->id}}" class="btn btn-primary">Cambiar Nivel Comisión (Compra)</a>

					  <button type="submit" class="btn btn-primary">Submit</button>
					</form>





					<h1>Boletos Comprados</h1>
<?php 
  $index = 0;
  $ref = 0;
  $total = 0;
?>
@foreach($arrTotal as $arr)
<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title">
      <h2>{{ $arr[$index]->post_title }}</h2>
        <div class="clearfix"></div>
    </div>
      <div class="x_content">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Código</th>
              <th>Cliente</th>
              <th>Comisión (Línea {{$usuario->nivel_linea}})</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
            @foreach($arr as $producto)
            <tr>
              <td scope="row"><i class='fa fa-ticket' aria-hidden='true'></i> {{ $producto->numero  }}</td>
               <td>{{ $producto->code }}</td>
              <td>{{ $producto->cliente }}</td>
              <td>$ {{ $producto->precio_publico * $usuario->comision_linea }}</td>
              <td>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </td>
            </tr>
            <?php 
              $total += ($producto->precio_publico * $usuario->comision_linea); 
            ?>;
            @endforeach
            <tr>
              <td colspan="3"></td>
              <td colspan="2"><b>Total: $ <?php echo $total; ?></b></td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>
</div>
<?php 
  $index++;
  $total = 0;
?>
@endforeach



	<h1>Compras</h1>
      <div class="x_content">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>total_compra</th>
              <th>cantidad_deposito</th>
              <th>precio_boleto</th>
              <th>cantidad_boletos</th>
              <th>fecha_deposito</th>
              <th>estado</th>
              <th>created_at</th>
              <th>ver</th>
            </tr>
          </thead>
          <tbody>
            @foreach($compras as $producto)
            <tr>
              <td scope="row">{{ $producto->id  }}</td>
               <td>$ {{ $producto->total_compra }}</td>
              <td>$ {{ $producto->cantidad_deposito }}</td>
              <td>$ {{ $producto->precio_boleto }}</td>
              <td># {{ $producto->cantidad_boletos }}</td>
              <td>{{ $producto->fecha_deposito }}</td>
              <td>{{ $producto->estado }}</td>
              <td>{{ $producto->created_at }}</td>
              <td><a href="/ver-compra/{{$producto->id}}" class="btn btn-info">ver</a></td>
            </tr>
            @endforeach>
          </tbody>
        </table>
      </div>




      <h1>Saldos</h1>
      <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th>nombre_producto</th>
                                <th>total_utilidad</th>
                                <th>estado</th>
                                <th>nivel_comision</th>
                                <th>created_at</th>
                                <th>Ver Boletos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($saldos as $saldo)
                            <tr>
                                <td>{{ $saldo->id }}</td>
                                <td>{{ $saldo->nombre_producto }}</td>
                                <td>{{ $saldo->total_utilidad }}</td>
                                <td>{{ $saldo->estado }}</td>
                                <td>{{ $saldo->nivel_comision }}</td>
                                <td>{{ $saldo->created_at }}</td>
                                <td><a href="/ver-saldo/{{ $saldo->id }}" class="btn btn-primary">Ver</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
