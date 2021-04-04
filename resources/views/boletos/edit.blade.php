@extends('boletos.layout-clients')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container">


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Boletos para "{{ $boletoPorCambiar->post_title }}" (seleccione nuevo boleto)</div>

                <div class="card-body">

                    <table style="width:100%" class="table-bordered">
                      {{-- <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Age</th>
                      </tr> --}}

                    <?php  
                        $f = 0;

                        for($i = 0; $i < 10; $i++){
                            echo "<tr>";
                            for($k = 0; $k < 10; $k++){
                                $m = $k + $f;
                                if($boletoPorCambiar->slug == $boletos[$m]->slug) {
                                    echo "<td id='". $boletos[$m]->numero ."' style='background-color:#50BD43; color: white; text-align:center;' ><i class='fa fa-ticket' aria-hidden='true'></i> ". $boletos[$m]->numero . "</td>";                                    
                                }
                                else if($boletos[$m]->estado == 1){
                                    echo "<td id='". $boletos[$m]->numero ."' style='background-color:#ff8080; color: white; text-align:center;' ><i class='fa fa-ticket' aria-hidden='true'></i> ". $boletos[$m]->numero . "</td>";                      
                                }
                                else{
                                    echo "<td class='disponible' style='text-align:center;' id='". $boletos[$m]->numero ."' onclick='myFunction(" . $boletos[$m]->numero .",". $boletos[$m]->id . ")'> ". $boletos[$m]->numero . " <i class='fa fa-ticket' aria-hidden='true'></i></td>";
                                }
                            }
                            $f += 10;
                            echo "</tr>";
                        }
                    ?>
                    </table>


                <br>
                <h3>Resumen del cambio</h3>
                <form method="POST" action="/cambio-boleto">
                    @csrf
                  <div class="form-group">
                    <label for="exampleInputEmail1"># boleto a cambiar</label>
                    <input type="number" value="{{$boletoPorCambiar->numero}}"class="form-control" id="boleto_anterior" name="boleto_anterior" aria-describedby="emailHelp" readonly>
                    <input type="number" value="{{$boletoPorCambiar->id}}"class="form-control" id="boleto_anterior_id" name="boleto_anterior_id" hidden>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1"># boleto nuevo</label>
                    <input type="number" class="form-control" id="boleto_nuevo" name="boleto_nuevo" readonly>
                    <input type="number" class="form-control" id="boleto_nuevo_id" name="boleto_nuevo_id" hidden>
                    <input type="text" value="{{$user->user_pass}}"class="form-control" id="usuario" name="usuario" hidden>
                    <input type="email" value="{{$user->user_email}}"class="form-control" id="usuario_correo" name="usuario_correo" hidden>
                    <input type="text" value="{{ $userSlug }}" class="form-control" id="ref" name="ref" hidden>
                  </div>
                  <button type="submit" class="btn btn-primary">Cambiar Boleto</button>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">

    document.getElementById('mis_boletos').href = "/cambiar-boletos/{{$userSlug}}";


function myFunction(numero,id) {

    document.getElementById('boleto_nuevo').value = numero;
    document.getElementById('boleto_nuevo_id').value = id;

    let long = document.getElementsByClassName('disponible').length;
    for(let i =0; i< long;  i++){
        document.getElementsByClassName('disponible')[i].style.color = 'black';
        document.getElementsByClassName('disponible')[i].style.background = 'white';
    }

    console.log("clic");
    console.log(numero);
    let node = document.getElementById(numero);
    console.log(node)
    node.style.color = 'white';
    node.style.background = 'lightblue';


}
</script>
@endsection
