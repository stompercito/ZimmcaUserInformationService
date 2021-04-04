@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!


                    

                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th>post_title</th>
                                <th>post_status</th>
                                <th>post_name</th>
                                <th>post_date</th>
                                <th>Acciones</th>
                                <th>Ver Boletos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $product)
                            <tr>
                                <td>{{ $product->ID }}</td>
                                <td>{{ $product->post_title }}</td>
                                <td>{{ $product->post_status }}</td>
                                <td>{{ $product->post_name }}</td>
                                <td>{{ $product->post_date }}</td>
          
                      
                                {{-- @can('products.show')--}}
                                <td width="10px">

                                    <form action="{{ route('boletos.store', $product->ID) }}" method="post">
                                    @method('POST')
                                    @csrf
                                        <button class="btn btn-danger btn-sm">Activar</button>
                                    </form>

                                </td>
                                <td><a href="/boletos/{{ $product->ID }}" class="btn btn-primary">Boletos</a></td>
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
