
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

<div class="col-md-8">
            <div class="card">
                <div class="card-header">Avisos</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <div class="card-body">

           <form action="/avisos/store" method="post" >
              @method('POST')
              @csrf
            <div class="form-group">
              <label>Titulo</label>
              <input type="text" class="form-control" id="titulo" name="titulo">
            </div>
            <div class="form-group">
              <label>Aviso</label>
              <br>
              <textarea name="aviso" id="aviso" rows="10" cols="50">Write something here</textarea>
            </div>
            <div class="form-group">
              <label>Dia</label>
              <input type="number" class="form-control" id="dia" name="dia">
            </div>
            <div class="form-group">
              <label>Mes</label>
              <input type="text" class="form-control" id="mes" name="mes" >
            </div>
            <div class="form-group">
              <label>Año</label>
              <input type="text" class="form-control" id="anio" name="anio">
            </div>
            <button type="submit" class="btn btn-primary">subir</button>

          </form>

                </div>
</div>
                </div>
            </div>
        </div>





    </div>
</div>
@endsection






