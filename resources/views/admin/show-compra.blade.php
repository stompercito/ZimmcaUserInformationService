
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Compra #{{ $compra->id }}</div>

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
                        <input type="number" class="form-control" id="ID" value="{{ $compra->id }}">
                      </div>
                      <div class="form-group">
                        <label>id_vendedor</label>
                        <input type="text" class="form-control" id="name" value="{{ $compra->id_vendedor }}">
                      </div>
                      <div class="form-group">
                        <label>cantidad_deposito</label>
                        <input type="text" class="form-control" id="email" value="{{ $compra->cantidad_deposito }}">
                      </div>
                      <div class="form-group">
                        <label>precio_boleto</label>
                        <input type="text" class="form-control" id="apellido_paterno" value="{{ $compra->precio_boleto }}">
                      </div>
                      <div class="form-group">
                        <label>cantidad_boletos</label>
                        <input type="text" class="form-control" id="apellido_materno" value="{{ $compra->cantidad_boletos }}">
                      </div>
                      <div class="form-group">
                        <label>ciudad</label>
                        <input type="text" class="form-control" id="sexo" value="{{ $compra->ciudad }}">
                      </div>
                      <div class="form-group">
                        <label>fecha_deposito</label>
                        <input type="text" class="form-control" id="fecha_nacimiento" value="{{ $compra->fecha_deposito }}">
                      </div>
                      <div class="form-group">
                        <label>estado</label>
                        <input type="text" class="form-control" id="direccion" value="{{ $compra->estado }}">
                      </div>
                      <div class="form-group">
                        <label>created_at</label>
                        <input type="text" class="form-control" id="cp" value="{{ $compra->created_at }}">
                      </div>

                      <a href="/descargar-comprobante/{{ $compra->id }}" class="btn btn-primary">Descargar Comprobante</a>
                      <br>
                      <br>
                      <a href="/autorizar-compra/{{ $compra->id }}" class="btn btn-primary">Autorizar Compra</a>                      
                    </form>



<br>
<h1>Boletos de la compra </h1>
       <div class="x_content">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Código</th>
              <th>Cliente</th>
              <th>Precio</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
            @foreach($boletos as $producto)
            <tr>
              <td scope="row"><i class='fa fa-ticket' aria-hidden='true'></i> {{ $producto->numero  }}</td>
               <td>{{ $producto->code }}</td>
              <td>{{ $producto->cliente }}</td>
              <td>$ {{ $producto->precio_publico }}</td>
              @if($producto->estado_orden == 1)
              <td>Activado</td>
              @else
              <td>Pendiente</td>
              @endif
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
@endsection
