
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">


      <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manual boletos en linea</div>
                <div class="card-body">
                          <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Borrar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $index = 1; ?>
                                @foreach($manuales as $manual)
                                    <tr>
                                        <th scope="row">{{ $index }}</th>
                                        <td>{{ $manual->id }}</td>
                                        <td>{{ $manual->nombre }}</td>
                                        <td>
                                            <a href="/manuales/borrar/{{$manual->id}}" 
                                                class="btn btn-round btn-info">
                                                borrar
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



      <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manual boletos en linea</div>
                <div class="card-body">
                    <form class="form-horizontal form-label-left"
                          method="post" 
                          enctype="multipart/form-data"
                          action="/manuales/store/venta-linea"
                          >
                          @method('POST')
                          @csrf
                    <div class="form-group">
                      <label>manual boletos linea</label>
                      <input type="file" class="form-control" id="manual_linea" name="manual_linea" >
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>

                </div>

              </div>
      </div>

       <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manual boletos en compra</div>
                <div class="card-body">
                    <form class="form-horizontal form-label-left"
                          method="post" 
                          enctype="multipart/form-data"
                          action="/manuales/store/venta-compra"
                          >
                          @method('POST')
                          @csrf
                    <div class="form-group">
                      <label for="exampleInputPassword1">manual boletos compra</label>
                      <input type="file" class="form-control" id="manual_compra" name="manual_compra" >
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>

                </div>

              </div>
      </div>

    </div>
</div>


@endsection






