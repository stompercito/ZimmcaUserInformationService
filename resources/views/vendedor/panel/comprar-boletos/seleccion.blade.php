@extends('vendedor.layouts.app')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Inicio</h3>
    </div>  
</div>

<div class="clearfix"></div>

<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Boletos para "{{ $rifa->post_title }}" </h5></div>

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
                               
                                if($boletos[$m]->estado == 1){
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
                <h3>Resumen de selección</h3>
                {{-- <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Username</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Larry</td>
                          <td>the Bird</td>
                          <td>@twitter</td>
                        </tr>
                      </tbody>
                    </table> --}}

                <form method="POST" action="/partner/buy-tickets/summary">
                    @csrf
                  <div class="form-group">
{{--                     <label for="exampleInputEmail1"># boleto a cambiar</label>
                    <input type="number" value=""class="form-control" id="boleto_anterior" name="boleto_anterior" aria-describedby="emailHelp" readonly>
                    <input type="number" value=""class="form-control" id="boleto_anterior_id" name="boleto_anterior_id" hidden>
                  </div> --}}
                  <div class="form-group">
                    <label for="exampleInputPassword1"># boletos seleccionados</label>
                    <br>
                    {{-- <input type="text" class="form-control" id="boleto_nuevo" name="boleto_nuevo" readonly> --}}
                    <textarea name="textarea" id="boleto_nuevo" rows="10" cols="50" readonly></textarea>
                    <input type="text" value="" class="form-control" id="boletos_id" name="boletos_id" hidden>
                  </div>
                  <button type="submit" class="btn btn-primary">Continuar</button>

                </form>
                </div>
            </div>
        </div>

</div>

<div class="row">
</div>
{{-- <div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Plain Page</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">



                 
                
                


            </div>
        </div>
    </div>
</div> --}}


<script type="application/javascript">

let arrBoletos = [];
let arrNumeros = [];


function myFunction(numero,id) {
    let index = arrBoletos.indexOf(id);

    if (index > -1) {
      arrBoletos.splice(index, 1);
        document.getElementById(numero).style.color = '#73879C';
        document.getElementById(numero).style.background = 'white';
    }else{
        arrBoletos.push(id);
        let node = document.getElementById(numero);
        node.style.color = 'white';
        node.style.background = 'lightblue';
        document.getElementById('boletos_id').value = JSON.stringify(arrBoletos);
    }

let index2 = arrNumeros.indexOf(numero);
console.log(index2)
    let cadena = "";
    if (index2 > -1) {
      arrNumeros.splice(index, 1);
        arrNumeros.forEach((e)=>{
            cadena += e + ",";
        })
        document.getElementById('boleto_nuevo').value = cadena;
    }else{
        arrNumeros.push(numero);
        arrNumeros.forEach((e)=>{
            cadena += e + ",";
        })
        document.getElementById('boleto_nuevo').value = cadena;
    }


}
</script>

@endsection
