@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Solicitudes de trabajo</div>

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
                                <th>name</th>
                                <th>email</th>
                                <th>apellido_paterno</th>
                                <th>apellido_materno</th>
                                <th>telefono</th>
                                <th>estado</th>
                                <th>tipo</th>
                                <th>created_at</th>
                                <th colspan="3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->apellido_paterno}}</td>
                                <td>{{ $value->apellido_materno }}</td>
                                <td>{{ $value->telefono }}</td>
                                @if($value->estado == 0)
                                <td><button type="text" class="btn btn-warning btn-sm">Pendiente</button></td>
                                @endif
                                @if($value->estado == 1)
                                <td><button type="text" class="btn btn-success btn-sm">Autorizado</button></td>
                                @endif
                                @if($value->estado == 2)
                                <td><button type="text" class="btn btn-danger btn-sm">Rechazado</button></td>
                                @endif
                                <td>{{ $value->tipo }}</td>
                                <td>{{ $value->created_at }}</td>
          
                                {{-- @can('products.show')--}}
                                <td width="10px">
                                    <a href="/ver-usuario/{{$value->id}}" class="btn btn-info btn-sm">ver</a>
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
