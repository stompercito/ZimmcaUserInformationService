
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
		<div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
               		<div class="card-body">
               			<a href="/crear-boletos" class="btn btn-primary">crear boletos</a>
               			<a href="/nuevas-solicitudes" class="btn btn-secondary">nueva solicitudes</a>
               			<a href="/usuarios" class="btn btn-success">usuarios</a>
               			<a href="/compras" class="btn btn-danger">compras</a>
               			<a href="/avisos" class="btn btn-warning">avisos</a>
               			<a href="/manuales" class="btn btn-info">manuales</a>



					</div>
			</div>
		</div>
    </div>
</div>






@endsection






