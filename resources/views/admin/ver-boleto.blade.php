@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Boleto {{ $producto->numero }} para rifa {{ $producto->post_title }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif                    

                <div class="card-body">

                	<form>
					  <div class="form-group">
					    <label>numero</label>
					    <input type="number" class="form-control" id="numero" value="{{ $producto->numero }}">
					  </div>
					  <div class="form-group">
					    <label>estado</label>
					    <input type="text" class="form-control" id="estado" value="{{ $producto->estado }}">
					  </div>
					  <div class="form-group">
					    <label>cliente</label>
					    <input type="text" class="form-control" id="cliente" value="{{ $producto->cliente }}">
					  </div>
					  <div class="form-group">
					    <label>vendedor</label>
					    <input type="text" class="form-control" id="vendedor" value="{{ $producto->vendedor }}">
					  </div>
					  <div class="form-group">
					    <label>modo_venta</label>
					    <input type="text" class="form-control" id="modo_venta" value="{{ $producto->modo_venta }}">
					  </div>
					  <div class="form-group">
					    <label>estado_cliente</label>
					    <input type="text" class="form-control" id="estado_cliente" value="{{ $producto->estado_cliente }}">
					  </div>
					  <div class="form-group">
					    <label>precio_vendedor</label>
					    <input type="text" class="form-control" id="precio_vendedor" value="{{ $producto->precio_vendedor }}">
					  </div>
					  <div class="form-group">
					    <label>precio_publico</label>
					    <input type="text" class="form-control" id="precio_publico" value="{{ $producto->precio_publico }}">
					  </div>
					  <div class="form-group">
					    <label>orden_id</label>
					    <input type="text" class="form-control" id="orden_id" value="{{ $producto->orden_id }}">
					  </div>
					  <div class="form-group">
					    <label>estado_orden</label>
					    <input type="text" class="form-control" id="estado_orden" value="{{ $producto->estado_orden }}">
					  </div>
					  
					  <a href="/boletos/{{$producto->ID}}" class="btn btn-primary">Regresar</a>

					</form>


@endsection
