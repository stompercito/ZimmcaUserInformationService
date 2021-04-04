
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">


<?php 
  $index = 0;
  $ref = 0;
?>

<div class="col-md-8">
            <div class="card">
                <div class="card-header">Boletos de Rifa {{ $producto_rifa->post_title }}</div>
                <a href="/crear-boletos" class="btn btn-primary">regresar</a>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <div class="card-body">
            <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>Cliente</th>
                              <th>Estado</th>
                              <th>Ver</th>
                            </tr>
                        </thead>
                        <tbody>
            @foreach($productos as $producto)
            <tr>
              <td scope="row"><i class='fa fa-ticket' aria-hidden='true'></i> {{ $producto->numero }}</td>
              <td> {{ $producto->cliente }} </td>
              @if($producto->estado_cliente == null)
              <td>
                  <div class="progress">
                    <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
              </td>
              @else
              <td>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </td>
              @endif
              <td><a href="/ver-boleto/{{ $producto->id }}" class="btn btn-primary">ver</a></td>

            </tr>

            @endforeach
          </tbody>
        </table>
      </div>
  </div>
</div>
<?php 
  $index++;
?>
                </div>
            </div>
        </div>





    </div>
</div>
@endsection






