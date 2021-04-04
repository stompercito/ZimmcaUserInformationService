@extends('layouts.app')

@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Estamos buscando tu talento</h1>
      <p class="lead">En DHIZO.com valoramos y reconocemos la riqueza que existe en la diversidad de pensamientos y opiniones. Queremos un ambiente diverso y colaborativo. Estamos comprometidos con fomentar una cultura de igualdad de oportunidades e inclusión laboral, donde nuestros socios se sientan libres de ser ellos mismos.
</p>
<br>
<p class="lead">
<h3>¿Qué buscamos? </h3>
<br>Talento como tú buscamos profesionales altamente comprometidos, apasionados por su trabajo, que disfruten colaborar en equipo. Dispuestos a tomar la iniciativa para formar parte de algo grandioso.
<br>
<h3>Requisitos:</h3>
{{-- <p class="lead"> --}}
      * Actitud, ganas de trabajar.<br>
  * Experiencia NO dispensable.<br>
  * Trabajo en equipo.<br>
{{-- </p> --}}
<br>
<br>
</p>
</div>

<div class="container">
      <div class="card-deck mb-3 text-center">
        {{-- <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Free</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$0 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>10 users included</li>
              <li>2 GB of storage</li>
              <li>Email support</li>
              <li>Help center access</li>
            </ul>
            <button type="button" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</button>
          </div>
        </div> --}}
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">¿Cómo funciona?</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4">
              <li>Al convertirte en socio DHIZO.com te conviertes de un distribuidor oficial de nuestros productos.</li>

            </ul>
            {{-- <button type="button" class="btn btn-lg btn-block btn-primary">¡Conviértete en distribuidor y empieza a ganar dinero ya!</button> --}}
            <a href="/register" class="btn btn-lg btn-block btn-primary">¡Conviértete en distribuidor y empieza a ganar dinero ya!</a>
          </div>
        </div>
{{--         <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Enterprise</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>30 users included</li>
              <li>15 GB of storage</li>
              <li>Phone and email support</li>
              <li>Help center access</li>
            </ul>
            <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>
          </div>
        </div> --}}
      </div>

    </div>
@endsection
