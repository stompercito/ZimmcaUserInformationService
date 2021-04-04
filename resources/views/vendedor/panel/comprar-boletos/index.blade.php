@extends('vendedor.layouts.app')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Comprar Boletos</h3>
    </div>  
</div>

<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12  ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Rifas Disponibles</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Rifa</th>
                                        <th>Boletos Disponibles</th>
                                        <th>Precio compra nivel ({{ $usuario->nivel_compra }})</th>
                                        <th>Comprar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $index = 1; ?>
                                @foreach($productos as $producto)
                                    <tr>
                                        <th scope="row">{{ $index }}</th>
                                        <td>{{ $producto->post_title }}</td>
                                        <td>{{ $producto->user_count }}</td>
                                        <td>$ {{ ($producto->meta_value - ($producto->meta_value * $usuario->comision_compra)) }}</td>
                                        <td>
                                            <a href="{{ route('buy.select', $producto->ID) }}" 
                                                class="btn btn-round btn-info">
                                        <i class="fa fa-shopping-cart"></i>
                                        </a>
                                        </td>
                                    </tr>
                                     <?php $index++; ?>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

{{--     <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Plain Page</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">



                 
                
                


            </div>
        </div>
    </div> --}}
</div>


@endsection
