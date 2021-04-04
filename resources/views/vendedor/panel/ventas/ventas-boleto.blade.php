@extends('vendedor.layouts.app')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Ventas de boletos comprados</h3>
    </div>  
</div>

<div class="clearfix"></div>


<?php 
  $index = 0;
  $ref = 0;
  $total_compra = 0;
  $total_venta = 0;
  $total_utilidad = 0;
?>
@foreach($arrTotal as $arr)
<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title">
      <h2>{{ $arr[$index]->post_title }} <small>Bordered table subtitle</small></h2>
        <div class="clearfix"></div>
    </div>
      <div class="x_content">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Código</th>
              <th>Cliente</th>
              <th>Compra</th>
              <th>Venta</th>
              <th>Utilidad</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
            @foreach($arr as $producto)
            <tr>
              {{-- <th scope="row">{{ $producto->id }}</th> --}}
              {{-- <td>{{ $producto->post_title }}</td> --}}
              <td scope="row"><i class='fa fa-ticket' aria-hidden='true'></i> {{ $producto->numero  }}</td>
              <td>{{ $producto->code }} </td>
              <td>{{ $producto->cliente }}</td>
              <td>$ {{ $producto->precio_vendedor }}</td>
              <td>$ {{ $producto->precio_publico }}</td>
              <td>$ {{ ($producto->precio_publico - $producto->precio_vendedor) }}</td>
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
            </tr>
            <?php 

              $total_compra += $producto->precio_vendedor;
              $total_venta += $producto->precio_publico;
              $total_utilidad += ($producto->precio_publico - $producto->precio_vendedor);
            ?>
            @endforeach
             <tr>
              <td colspan="2"></td>
              <td><b>Total:</b></td>
              <td><b>$ <?php echo $total_compra; ?></b></td>
              <td><b>$ <?php echo $total_venta; ?></b></td>
              <td colspan="2"><b>$ <?php echo $total_utilidad; ?></b></td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>
</div>
<?php 
  $index++;
?>
@endforeach







{{-- <div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Plain Page</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">


<?php 
date_default_timezone_set('America/Mexico_City');
    $d = new DateTime();
    echo $d->format('Y-m-d H:i:s');
    

?>
                 
                
                


            </div>
        </div>
    </div>
</div> --}}


@endsection
