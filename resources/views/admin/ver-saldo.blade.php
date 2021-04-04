@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Saldo de  {{ $saldo->id }} para rifa {{ $saldo->nombre_producto }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif                    

                <div class="card-body">
					<a href="/ver-usuario/{{$saldo->id_vendedor}}" class="btn btn-success" style="float:right;">Regresar</a>
					<br>
                	<form>
					  <div class="form-group">
					    <label>id</label>
					    <input type="number" class="form-control" id="id" value="{{ $saldo->id }}">
					  </div>
					  <div class="form-group">
					    <label>nombre_producto</label>
					    <input type="text" class="form-control" id="nombre_producto" value="{{ $saldo->nombre_producto }}">
					  </div>
					  <div class="form-group">
					    <label>id_vendedor</label>
					    <input type="text" class="form-control" id="id_vendedor" value="{{ $saldo->id_vendedor }}">
					  </div>
					  <div class="form-group">
					    <label>total_utilidad</label>
					    <input type="text" class="form-control" id="total_utilidad" value="{{ $saldo->total_utilidad }}">
					  </div>
					  <div class="form-group">
					    <label>estado</label>
					    <input type="text" class="form-control" id="estado" value="{{ $saldo->estado }}">
					  </div>
					  <div class="form-group">
					    <label>nivel_comision</label>
					    <input type="text" class="form-control" id="ivel_comision" value="{{ $saldo->nivel_comision }}">
					  </div>
					  <div class="form-group">
					    <label>created_at</label>
					    <input type="text" class="form-control" id="precio_vendedor" value="{{ $saldo->created_at }}">
					  </div>

					</form>

					<h3>Subir Comprobante</h3>
					<form id="demo-form2" 
                          method="post" 
                          enctype="multipart/form-data"
                          action="/subir-comprobante-saldo/"
                          >
                          @method('POST')
                          @csrf
                      <div class="form-group">
					    <label>comprobante deposito</label>
					    <input type="file" class="form-control" id="comprobante" name="comprobante">
					    <input type="number" class="form-control" id="id_saldo" name="id_saldo" value="{{$saldo->id}}" hidden>
					    <input type="number" class="form-control" id="id_saldo" name="id_socio" value="{{$saldo->id_vendedor}}" hidden>
					    <br>
					    <br>
					    <button type="submit" class="btn btn-primary">subir archivo</button>
					  </div>

                    </form>
                    <a href="/descargar-comprobante-saldo/{{$saldo->id}}" class="btn btn-success">descargar comprobante</a>




@endsection
