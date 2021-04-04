@extends('vendedor.layouts.app')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Mis Ventas</h3>
    </div>  
</div>

<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Seleccione una opción:</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">


                <div class="col-md-12 col-sm-12  ">
                    
                    <div class="col-md-6 col-sm-6  ">
                     <a href="/partner/sales-vendor" 
                        class="btn btn-success" 
                        style="height: 150px; width: 70%; float: right;"
                        >
                    <i class="fa fa-money" style="font-size: 50px; color:white;"></i> 
                    <br>
                     <h3 style="color:white;">Boletos comprados</h3>
                     {{-- <h6 style="color:white;">*Lorem</h6> --}}
                    </a>
                 </div> 
                 
                <div class="col-md-6 col-sm-6  ">
                     <a href="/partner/sales-online" 
                        class="btn btn-info" 
                        style="height: 150px; width: 70%;"
                        >
                    <i class="fa fa-share-alt" style="font-size: 50px; color:white;"></i> 
                    <br>
                     <h3 style="color:white;">Boletos en línea</h3>
                     {{-- <h6 style="color:white;">*Lorem</h6> --}}
                    </a>
                 </div>

                </div>
                 
                
                


            </div>
        </div>
    </div>
</div>


@endsection
