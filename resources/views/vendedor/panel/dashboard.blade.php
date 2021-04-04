@extends('vendedor.layouts.app')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Panel de Control</h3>
    </div>  
</div>

<div class="clearfix"></div>

<div class="x_panel">
                  <div class="x_title">
                    <h2>Información Importante</h2>
                      <ul class="nav navbar-right panel_toolbox">
                      
                      <li style="color: white;">
                        <a class="btn btn-success" href="/partner/info-earn">
                          <span style="color: white;" class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Información </a>
                      </li>

                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <!-- start form for validation -->
                    <form id="demo-form" data-parsley-validate="" novalidate="">
                      {{-- <label for="fullname">Full Name * :</label> --}}
                      <h2>Código de socio</h2>
                      @if(Auth::user()->url == null)
                      <input type="text" id="email" class="form-control" readonly value="solicitud en revisión">
                      @else
                      <input type="text" id="fullname" class="form-control" value="{{  Auth::user()->id }}" readonly>
                      @endif

                      {{-- <label for="email">Email * :</label> --}}
                      <h2>URL de socio</h2>
                      @if(Auth::user()->url == null)
                      <input type="text" id="email" class="form-control" readonly value="solicitud en revisión">
                      @else
                      <input type="text" id="email" class="form-control" value="{{  Auth::user()->url }}" readonly >
                      @endif
                  </div>
                </div>


@if(Auth::user()->url == null)
  <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Existen 2 maneras en la que puedes ganar dinero con nosotros (Línea y Compra).</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">


                    <!-- start project-detail sidebar -->
                    <div class="col-md-12 col-sm-12  ">

                      <section class="panel">

                        <div class="panel-body">
                          <h3 class="green"><i class="fa fa-share-alt"></i> Línea</h3>

                          <p>
                            <h6>* Consiste en que los clientes utilicen tu código de socio o tu URL en sus compras y así recibir una comisión por cada boleto vendido.</h6>
                           </p>
                          <br>

                    {{--       <div class="project_detail">

                            <p class="title">Client Company</p>
                            <p>Deveint Inc</p>
                            <p class="title">Project Leader</p>
                            <p>Tony Chicken</p>
                          </div> --}}

                         {{--  <br> --}}
                          <h4><i>Descargar manuales</i></h4>
                          <ul class="list-unstyled project_files">
{{--                             <li><a href=""><i class="fa fa-file-word-o"></i> Functional-requirements.docx</a>
                            </li> --}}
                            <li><a href=""><i class="fa fa-file-pdf-o"></i>venta-boletos-linea.pdf</a>
                            </li>
{{--                             <li><a href=""><i class="fa fa-mail-forward"></i> Email-from-flatbal.mln</a>
                            </li>
                            <li><a href=""><i class="fa fa-picture-o"></i> Logo.png</a>
                            </li>
                            <li><a href=""><i class="fa fa-file-word-o"></i> Contract-10_12_2014.docx</a>
                            </li> --}}
                          </ul>
                          <br>

                        </div>

                      </section>

                    </div>


                    <div class="col-md-12 col-sm-12  ">

                      <section class="panel">

                        <div class="panel-body">
                          <h3 class="green"><i class="fa fa-money"></i> Compra</h3>

                          <p>
                            <h6>* Consiste en la compra y venta de los boletos de las rifas, dependiendo de tu nivel de comisión es el margen de ganancia que puedes obtener.</h6>
                           </p>
                          <br>

                         {{--  <div class="project_detail">

                            <p class="title">Client Company</p>
                            <p>Deveint Inc</p>
                            <p class="title">Project Leader</p>
                            <p>Tony Chicken</p>
                          </div>
 --}}
                          {{-- <br> --}}
                          <h4><i>Descargar manuales</i></h4>
                          <ul class="list-unstyled project_files">
                            <li><a href=""><i class="fa fa-file-pdf-o"></i>venta-boletos-compra.pdf</a>
                            </li>
                            {{-- <li><a href=""><i class="fa fa-file-word-o"></i> Functional-requirements.docx</a>
                            </li>
                            <li><a href=""><i class="fa fa-file-pdf-o"></i> UAT.pdf</a>
                            </li>
                            <li><a href=""><i class="fa fa-mail-forward"></i> Email-from-flatbal.mln</a>
                            </li>
                            <li><a href=""><i class="fa fa-picture-o"></i> Logo.png</a>
                            </li>
                            <li><a href=""><i class="fa fa-file-word-o"></i> Contract-10_12_2014.docx</a>
                            </li> --}}
                          </ul>
                          <br>

                        </div>

                      </section>

                      <p>
                        <h6>(Las opciones anteriores están sujetas a 2 niveles de comisión (Intermedio y Avanzado) que se describen a continuación.)</h6>
                      </p>

                    </div>


                    <!-- end project-detail sidebar -->

                  </div>
                </div>
              </div>
            {{-- </div> --}}




            <div class="clearfix"></div>


            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel" style="height:600px;">
                  <div class="x_title">
                    <h2>Niveles de comisión</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="row">

                      <div class="col-md-12">

                        <!-- price element -->
                        <div class="col-md-3 col-sm-6  ">
                          <div class="pricing">
                            <div class="title">
                              <h2>Ventas en Línea</h2>
                              <h1>Nivel de comisión (Avanzado)</h1>
                            </div>
                            <div class="x_content">
                              <div class="">
                                <div class="pricing_features">
                                  <ul class="list-unstyled text-left">
                                   <li><i class="fa fa-check text-success"></i><strong> % 10 por boleto</strong></li>
{{--                                     <li><i class="fa fa-times text-danger"></i> 2 years access <strong> to all storage locations</strong></li>
                                    <li><i class="fa fa-times text-danger"></i> <strong>Unlimited</strong> storage</li>
                                    <li><i class="fa fa-check text-success"></i> Limited <strong> download quota</strong></li>
                                    <li><i class="fa fa-check text-success"></i> <strong>Cash on Delivery</strong></li>
                                    <li><i class="fa fa-check text-success"></i> All time <strong> updates</strong></li>
                                    <li><i class="fa fa-times text-danger"></i> <strong>Unlimited</strong> access to all files</li>
                                    <li><i class="fa fa-times text-danger"></i> <strong>Allowed</strong> to be exclusing per sale</li> --}}
                                  </ul>
                                </div>
                              </div>
{{--                               <div class="pricing_footer">
                                <a href="javascript:void(0);" class="btn btn-success btn-block" role="button">Download <span> now!</span></a>
                                <p>
                                  <a href="javascript:void(0);">Sign up</a>
                                </p>
                              </div> --}}
                            </div>
                          </div>
                        </div>
                        <!-- price element -->

                        <!-- price element -->
                        <div class="col-md-3 col-sm-6  ">
                          <div class="pricing ui-ribbon-container">
                            <div class="ui-ribbon-wrapper">
                              <div class="ui-ribbon">
                                Inicial
                              </div>
                            </div>
                            <div class="title">
                               <h2>Ventas en Línea</h2>
                              <h1>Nivel de comisión (Intermedio)</h1>

                              {{-- <span>Monthly</span> --}}
                            </div>
                            <div class="x_content">
                              <div class="">
                                <div class="pricing_features">
                                  <ul class="list-unstyled text-left">
                                  <li><i class="fa fa-check text-success"></i><strong> % 5 por boleto</strong></li>
{{--                                     <li><i class="fa fa-check text-success"></i> 2 years access <strong> to all storage locations</strong></li>
                                    <li><i class="fa fa-check text-success"></i> <strong>Unlimited</strong> storage</li>
                                    <li><i class="fa fa-check text-success"></i> Limited <strong> download quota</strong></li>
                                    <li><i class="fa fa-check text-success"></i> <strong>Cash on Delivery</strong></li>
                                    <li><i class="fa fa-check text-success"></i> All time <strong> updates</strong></li>
                                    <li><i class="fa fa-times text-danger"></i> <strong>Unlimited</strong> access to all files</li>
                                    <li><i class="fa fa-times text-danger"></i> <strong>Allowed</strong> to be exclusing per sale</li> --}}
                                  </ul>
                                </div>
                              </div>
 {{--                              <div class="pricing_footer">
                                <a href="javascript:void(0);" class="btn btn-primary btn-block" role="button">Download <span> now!</span></a>
                                <p>
                                  <a href="javascript:void(0);">Sign up</a>
                                </p>
                              </div> --}}
                            </div>
                          </div>
                        </div>
                        <!-- price element -->

                        <!-- price element -->
                        <div class="col-md-3 col-sm-6  ">
                          <div class="pricing">
                            <div class="title">
                             <h2>Ventas por Compra</h2>
                              <h1>Nivel de comisión (Avanzado)</h1>
                              {{-- <span>Monthly</span> --}}
                            </div>
                            <div class="x_content">
                              <div class="">
                                <div class="pricing_features">
                                  <ul class="list-unstyled text-left">
                                  <li><i class="fa fa-check text-success"></i><strong> % 20 por boleto</strong></li>
{{--                                     <li><i class="fa fa-check text-success"></i> 2 years access <strong> to all storage locations</strong></li>
                                    <li><i class="fa fa-check text-success"></i> <strong>Unlimited</strong> storage</li>
                                    <li><i class="fa fa-check text-success"></i> Limited <strong> download quota</strong></li>
                                    <li><i class="fa fa-check text-success"></i> <strong>Cash on Delivery</strong></li>
                                    <li><i class="fa fa-check text-success"></i> All time <strong> updates</strong></li>
                                    <li><i class="fa fa-times text-danger"></i> <strong>Unlimited</strong> access to all files</li>
                                    <li><i class="fa fa-times text-danger"></i> <strong>Allowed</strong> to be exclusing per sale</li> --}}
                                  </ul>
                                </div>
                              </div>
                {{--               <div class="pricing_footer">
                                <a href="javascript:void(0);" class="btn btn-success btn-block" role="button">Download <span> now!</span></a>
                                <p>
                                  <a href="javascript:void(0);">Sign up</a>
                                </p>
                              </div> --}}
                            </div>
                          </div>
                        </div>
                        <!-- price element -->

                        <!-- price element -->
                        <div class="col-md-3 col-sm-6  ">
                          <div class="pricing ui-ribbon-container">
                            <div class="ui-ribbon-wrapper">
                              <div class="ui-ribbon">
                                Inicial
                              </div>
                            </div>
                            <div class="title">
                             <h2>Ventas por Compra</h2>
                              <h1>Nivel de comisión (Intermedio)</h1>
                              {{-- <span>Monthly</span> --}}
                            </div>
                            <div class="x_content">
                              <div class="">
                                <div class="pricing_features">
                                  <ul class="list-unstyled text-left">
                                    <li><i class="fa fa-check text-success"></i><strong> % 15 por boleto</strong></li>
  {{--                                   <li><i class="fa fa-check text-success"></i> <strong>Unlimited</strong> storage</li>
                                    <li><i class="fa fa-check text-success"></i> Limited <strong> download quota</strong></li>
                                    <li><i class="fa fa-check text-success"></i> <strong>Cash on Delivery</strong></li>
                                    <li><i class="fa fa-check text-success"></i> All time <strong> updates</strong></li>
                                    <li><i class="fa fa-times text-danger"></i> <strong>Unlimited</strong> access to all files</li>
                                    <li><i class="fa fa-times text-danger"></i> <strong>Allowed</strong> to be exclusing per sale</li> --}}
                                  </ul>
                                </div>
                              </div>
 {{--                              <div class="pricing_footer">
                                <a href="javascript:void(0);" class="btn btn-primary btn-block" role="button">Download <span> now!</span></a>
                                <p>
                                  <a href="javascript:void(0);">Sign up</a>
                                </p>
                              </div> --}}
                            </div>
                          </div>
                        </div>
                        <!-- price element -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

@else

<div class="x_panel">
    <div class="x_title">
    <h2>Resumen</h2>
        <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row" style="display: inline-block;">
            <div class="top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-ticket"></i></div>
                  <div class="count">{{$total_boletos_vendidos}}</div>
                  <h3>Boletos Vendidos</h3>
                  {{-- <p>Lorem ipsum psdea itgum rixt.</p> --}}
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-users"></i></div>
                  <div class="count">{{$total_clientes}}</div>
                  <h3>Clientes</h3>
                  {{-- <p>Lorem ipsum psdea itgum rixt.</p> --}}
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-share-alt"></i></div>
                  <div class="count">{{$total_boletos_linea}}</div>
                  <h3>Boletos (línea)</h3>
                  {{-- <p>Lorem ipsum psdea itgum rixt.</p> --}}
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-money"></i></div>
                  <div class="count">{{$total_boletos_fisico}}</div>
                  <h3>Boletos (compra)</h3>
                  {{-- <p>Lorem ipsum psdea itgum rixt.</p> --}}
                </div>
              </div>
            </div>
          </div>
        </div>
</div>





<div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Panel de Control</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">



        <div class="col-md-4">
        <div class="x_panel">
                  <div class="x_title">
                    <h2>Avisos Importantes</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                 @foreach($avisos as $aviso)
                    <article class="media event">
                      <a class="pull-left date">
                        <p class="month">{{$aviso->mes}}</p>
                        <p class="day">{{$aviso->dia}}</p>
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">{{$aviso->titulo}}</a>
                        <p>{{$aviso->aviso}}</p>
                      </div>
                    </article>
                @endforeach


                    
                  </div>
        </div>
    </div>



                    <div class="col-md-3 col-sm-12 ">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>Top 5 Clientes</h2>
                          <div class="clearfix"></div>
                        </div>
                        <ul class="list-unstyled top_profiles scroll-view">

                        @foreach($top5Clientes as $cliente)
                        <li class="media event">
                            <a class="pull-left border-blue profile_thumb">
                              <i class="fa fa-user blue"></i>
                            </a>
                            <div class="media-body">
                              <a class="title" href="#">{{$cliente->cliente}}</a>
                              <p>Boletos comprados: <strong>{{$cliente->num}}</strong></p>
                            </div>
                          </li>
                        @endforeach
                        </ul>
                      </div>
                    </div>



                    <div class="col-md-4 col-sm-6 ">
                <div class="x_panel fixed_height_320">
                  <div class="x_title">
                    <h2>Boletos ocupados</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @foreach($boletosOcupados as $boleto)
                        <div class="widget_summary">
                          <div class="w_left w_25">
                            <span>{{$boleto->post_title}}</span>
                          </div>
                          <div class="w_center w_55">
                            <div class="progress">
                              <div class="progress-bar bg-green" role="progressbar" style="width: {{$boleto->ocupados}}%;">
                                <span class="sr-only">{{$boleto->ocupados}}</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>{{$boleto->ocupados}}/100</span>
                          </div>
                          <div class="clearfix"></div>
                        </div>      
                    @endforeach

                  </div>
                </div>
              </div>






                  </div>
                </div>
              </div>
            </div>



@endif




@endsection
