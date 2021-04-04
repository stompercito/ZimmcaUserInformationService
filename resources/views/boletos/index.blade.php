@extends('boletos.layout-clients')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mis Boletos 
                    <svg width="1em" 
                            height="1em" 
                            viewBox="0 0 16 16" 
                            class="bi bi-file-earmark-text" 
                            fill="currentColor" 
                            xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z"/>
                    <path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z"/>
                    <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table" id="table"> 
                            <thead  class=" text-primary">
                                <tr  class="info">
                                    <th># Boleto </th>
                                    <th>Rifa</th>
                                    {{-- <th>Descripción</th> --}}
                                    <th class='text-right'>Cambiar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($boletos as $value)
                                    <tr>
                                        <td># {{$value->numero}} <i class="fa fa-ticket" aria-hidden="true"></i></td>
                                        <td>{{ $value->post_title }}</td>
                                       {{--  <td>{{ $value->descripcion }}</td> --}}
                                       @if($value->estado_orden == null)
                                        <td class="td-actions text-right">
                                            <a class="edit-modal btn btn-success btn-link" 
                                                href="/seleccionar-boletos/{{$client_slug->slug}}/{{$value->code}}" >
                                                <i class="fa fa-exchange" aria-hidden="true" style="color: white;"></i>
                                            </a> 
                                        </td>
                                        @else
                                        <td class="td-actions text-right">
                                            (no se puede cambiar el #)
                                        </td>
                                       @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
    document.getElementById('mis_boletos').href = "/cambiar-boletos/{{$client_slug->slug}}" ;
</script>

@endsection
