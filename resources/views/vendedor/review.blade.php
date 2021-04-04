@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

@if(session()->get( 'vendedor' ) != null)
	<?php  
		$vendedor = session()->get( 'vendedor' );
		echo $vendedor; 

	?>
	<div class="jumbotron">
    <h1>Navbar example</h1>
    <p class="lead">This example is a quick exercise to illustrate how the top-aligned navbar works. As you scroll, this navbar remains in its original position and moves with the rest of the page.</p>
    <a class="btn btn-lg btn-primary" href="/mx" role="button">View navbar docs »</a>
  </div>

@else  
	no hay vendedrlr
	<div class="jumbotron">
    <h1>Navbar example</h1>
    <p class="lead">This example is a quick exercise to illustrate how the top-aligned navbar works. As you scroll, this navbar remains in its original position and moves with the rest of the page.</p>
    <a class="btn btn-lg btn-primary" href="/first-register" role="button">View navbar docs »</a>
  </div>
@endif


    </div>
</div>
@endsection




