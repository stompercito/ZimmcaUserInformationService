@extends('vendedor.layouts.app')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Saldos</h3>
    </div>  
</div>



    <div class="col-md-12 col-sm-12">
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
                          <th>Comisión nivel</th>
                          <th>Total comisión</th>
                          <th>Estado</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $index = 1;
                        ?>
                          @foreach($ventas as $venta)
                                 <tr>
                                    <th scope="row">{{ $index }}</th>
                                    <td>{{ $venta->nombre_producto }}</td>
                                    <td>{{ $venta->nivel_comision }}</td>
                                    <td>$ {{ $venta->total_utilidad }} </td>
                                    @if($venta->estado == 0)
                                        <td><button type="text" class="btn btn-warning">pendiente</button></td>
                                    @else
                                        <td><a href="/partner/download-voucher/{{$venta->id}}" class="btn btn-success"><span class="glyphicon glyphicon-download" aria-hidden="true"></span> comprobante</a></td>
                                    @endif
                                     <?php 
                                     $index++; 
                                     ?>
                          @endforeach
                    </table>

            </div>
        </div>
    </div>


@endsection
