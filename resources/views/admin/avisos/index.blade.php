
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

<div class="col-md-8">
            <div class="card">
                <div class="card-header">Avisos</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <div class="card-body">
                  <a href="/avisos/create" class="btn btn-success">nuevo</a>
                  <br>
                   <br>
            <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                              <th>id</th>
                              <th>titulo</th>
                              <th>Ver</th>
                            </tr>
                        </thead>
                        <tbody>
            @foreach($avisos as $aviso)
            <tr>
              <td>{{ $aviso->id }}</td>
              <td> {{ $aviso->titulo }} </td>
              <td>
                <a href="/ver-boleto/{{ $aviso->id }}" class="btn btn-primary">ver</a>
                <a href="/avisos/edit/{{$aviso->id}}" class="btn btn-success">editar</a>
                <a href="/avisos/delete/{{$aviso->id}}" class="btn btn-danger">editar</a>
              </td>
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





    </div>
</div>
@endsection






