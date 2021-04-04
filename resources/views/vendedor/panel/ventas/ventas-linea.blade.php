@extends('vendedor.layouts.app')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Ventas de boletos en línea</h3>
    </div>  
</div>



<?php 
  $index = 0;
  $ref = 0;
  $total = 0;
?>
@foreach($arrTotal as $arr)
<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title">
      <h2>{{ $arr[$index]->post_title }} {{-- <small>Bordered table subtitle</small> --}}</h2>
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
            ?>
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





@endsection
