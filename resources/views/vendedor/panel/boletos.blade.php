@extends('vendedor.layouts.app')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Mis boletos</h3>
    </div>  
</div>

<?php 
  $index = 0;
  $ref = 0;
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
              <th>Descargar</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
            @foreach($arr as $producto)
            <tr>
              {{-- <th scope="row">{{ $producto->id }}</th> --}}
              {{-- <td>{{ $producto->post_title }}</td> --}}
              <td scope="row"><i class='fa fa-ticket' aria-hidden='true'></i> {{ $producto->numero  }}</td>
              @if($producto->estado_orden == 0)
               <td>(pago en revisión)</td>
              @else
              <td> {{ $producto->code }} </td>
              @endif
              @if($producto->estado_orden == 0)
               <td>(pago en revisión)</td>
              @else
              <td><a href="/download/ticket/{{ ($producto->code)  }}"><i class="fa fa-cloud-download"></i></a></td>
              @endif
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
            @endforeach
          </tbody>
        </table>
      </div>
  </div>
</div>
<?php 
  $index++;
?>
@endforeach











@endsection
