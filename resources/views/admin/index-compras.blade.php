
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ver todas las compras</div>

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
                                <th width="10px">ID</th>
                                <th>id_vendedor</th>
                                <th>total_compra</th>
                                <th>cantidad_boletos</th>
                                <th>created_at</th>
                                <th>estado</th>
                                <th colspan="3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($compras as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->id_vendedor }}</td>
                                <td>$ {{ $product->total_compra }}</td>
                                <td>{{ $product->cantidad_boletos }}</td>
                                <td>{{ $product->created_at }}</td>
                                @if($product->estado == 0)
                                <td><button type="text" class="btn btn-warning">Pendiente</button></td>
                                @else
                                 <td><button type="text" class="btn btn-success">Activado</button></td>
                                @endif
                                <td width="10px">
                                    <a href="/ver-compra/{{$product->id}}" class="btn btn-info" >ver</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                   {{--  {{ $productos->render() }} --}}
                </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
