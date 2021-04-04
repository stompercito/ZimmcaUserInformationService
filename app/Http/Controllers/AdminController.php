<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Storage;
use App\LuagaresRifa;
use App\VendorVenta;
use Illuminate\Support\Facades\File; 

class AdminController extends Controller
{
    public function verBoletos($id){
    	
    }


    public function index(){
        if(Auth::user()->tipo == 1){
            $usuarios = DB::table('users')
                ->where('estado',0)
                ->get();
            return view('admin.index');
        }else{
            return redirect('/mx');
        }
    }


    public function indexSolicitudes(){

    	if(Auth::user()->tipo == 1){
    		$usuarios = DB::table('users')
    			->where('estado',0)
                ->get();
            return view('admin.ver-solicitudes',compact('usuarios'));
        }else{
            return redirect('/mx');
        }

    }

    public function verUsuarios(){
    	if(Auth::user()->tipo == 1){
    		$usuarios = DB::table('users')
                ->get();
            return view('admin.ver-usuarios',compact('usuarios'));
        }else{
            return redirect('/mx');
        }
    }


    public function verUsuario($id){
    	if(Auth::user()->tipo == 1){
    		$usuario = DB::table('users')
    			        ->join('precio_vendors', 'users.id', '=', 'precio_vendors.id')
		                ->where('users.id', $id)
		                ->first();

		    // Todos los boletos que ha comprado el usuario por rifa

		     $productos = DB::table('luagares_rifas')
                    ->join('wp_posts', 'wp_posts.ID', '=', 'luagares_rifas.id_producto')
                    ->where([
                            ['luagares_rifas.vendedor', '=', $id]
                    ])->get();


	        $id_productos = DB::table('luagares_rifas')
	                    ->select('luagares_rifas.id_producto')
	                    ->distinct()
	                    ->where([
	                            ['luagares_rifas.vendedor', '=', $id]
	                    ])->get();


	        $arrTotal = [];

	        for($i=0; $i< count($id_productos) ; $i++ ){
	            $arrTemp = [];
	            foreach ($productos as $producto) {   
	                if($producto->id_producto ==  $id_productos[$i]->id_producto){
	                    array_push($arrTemp, $producto);
	                }
	            }
	            $arrTotal[$i] = $arrTemp;
	        }


	        // Compras del cliente
	        $compras = DB::table('boletos_vendors')
	                    ->where([
	                            ['id_vendedor', '=', $id]
	                    ])->get();
	       // return $compras;

            $saldos = DB::table('vendor_ventas')
                        ->where([
                                ['id_vendedor', '=', $id]
                        ])->get();



            return view('admin.ver-usuario',compact('usuario','arrTotal','compras','saldos'));
        }else{
            return redirect('/mx');
        }
    }
    public function generarUrl($id){
    	if(Auth::user()->tipo == 1){
    		$url = "https://www.dhizo.com/mx/?partner=".$id;
    		$user = User::find($id);
    		$user->url = $url;
    		$user->save();
    		$redirect = "/ver-usuario/". $id;
            return redirect($redirect);
        }else{
            return redirect('/mx');
        }
    }

    public function cambiarEstado($id){
    	if(Auth::user()->tipo == 1){
    		$user = User::find($id);

    		if($user->estado == 0){
    			$user->estado = 1;
    		}else if ($user->estado == 1){
    			$user->estado = 0;
    		}else{
    			$user->estado == 0;
    		}
    		$user->save();

    		$redirect = "/ver-usuario/". $id;
            return redirect($redirect);
        }else{
            return redirect('/mx');
        }
    }

    public function desactivarUsuario($id){
    	if(Auth::user()->tipo == 1){
    		$user = User::find($id);

    		if($user->estado == 0 || $user->estado == 1 ){
    			$user->estado = 2;
    		}else if ($user->estado == 2){
    			$user->estado = 0;
    		}else{
    			$user->estado == 0;
    		}
    		$user->save();

    		$redirect = "/ver-usuario/". $id;
            return redirect($redirect);
        }else{
            return redirect('/mx');
        }
    }

    public function cambiarNivelLinea($id){
    	if(Auth::user()->tipo == 1){

    		$precio = DB::table('precio_vendors')
		                ->where('id_vendedor', $id)
		                ->first();

		    if($precio->nivel_linea == 'Intermedio'){
		    	DB::table('precio_vendors')
		    		->where('id_vendedor',$id)
		    		->update([
		    			'comision_linea' => 0.1,
		    			'nivel_linea' => 'Avanzado',
		    	]);
		    }else{
		    	DB::table('precio_vendors')
		    		->where('id_vendedor',$id)
		    		->update([
		    			'comision_linea' => 0.05,
		    			'nivel_linea' => 'Intermedio',
		    	]);
		    }



    		$redirect = "/ver-usuario/". $id;
            return redirect($redirect);
        }else{
            return redirect('/mx');
        }
    }


    public function CambiarNivelCompra($id){
    	if(Auth::user()->tipo == 1){

    		$precio = DB::table('precio_vendors')
		                ->where('id_vendedor', $id)
		                ->first();

    		if($precio->nivel_compra == 'Intermedio'){
		    	DB::table('precio_vendors')
		    		->where('id_vendedor',$id)
		    		->update([
		    			'comision_compra' => 0.20,
		    			'nivel_compra' => 'Avanzado',
		    	]);
		    }else{
		    	DB::table('precio_vendors')
		    		->where('id_vendedor',$id)
		    		->update([
		    			'comision_compra' => 0.10,
		    			'nivel_compra' => 'Intermedio',
		    	]);
		    }

    		$redirect = "/ver-usuario/". $id;
            return redirect($redirect);
        }else{
            return redirect('/mx');
        }
    }

    public function indexCompras(){
    	if(Auth::user()->tipo == 1){
    		$compras = DB::table('boletos_vendors')
                ->get();

            //return $compras;
            return view('admin.index-compras',compact('compras'));
        }else{
            return redirect('/mx');
        }
    }
    public function verCompra($id){
    	if(Auth::user()->tipo == 1){
    		$compra = DB::table('boletos_vendors')
    			->where('id',$id)
                ->first();

            $boletos = DB::table('luagares_rifas')
			    		->where('orden_id',$id)
			    		->get();

            return view('admin.show-compra',compact('compra','boletos'));
        }else{
            return redirect('/mx');
        }
    }

    public function descargarComprobante($id){
    	if(Auth::user()->tipo == 1){
    		$compra = DB::table('boletos_vendors')
    			->where('id',$id)
                ->first();

            return Storage::download($compra->url_imagen_depostio);
        }else{
            return redirect('/mx');
        }
    }

    public function autorizarCompra($id){

    	if(Auth::user()->tipo == 1){

	    	DB::table('boletos_vendors')
			    		->where('id',$id)
			    		->update([
			    			'estado' => 1,
			    	]);

			$boletos = DB::table('luagares_rifas')
			    		->where('orden_id',$id)
			    		->get();

			foreach ($boletos as $value) {
				$boleto = LuagaresRifa::find($value->id);
				$boleto->estado_orden = 1;
				$boleto->save();
			}

            $redirect = "/ver-compra/". $id;
            return redirect($redirect);
        }else{
            return redirect('/mx');
        }

    }

    public function indexBoletos($id){
    	if(Auth::user()->tipo == 1){

			$productos = DB::table('luagares_rifas')
                    ->join('wp_posts', 'wp_posts.ID', '=', 'luagares_rifas.id_producto')
                    ->where('luagares_rifas.id_producto', $id)
					->get();

			$producto_rifa = DB::table('wp_posts')
                    ->where('ID', $id)
					->first();


	        return view('admin.index-boletos',compact('productos','producto_rifa'));
        }else{
            return redirect('/mx');
        }
    }


    public function verBoleto($id){
    	if(Auth::user()->tipo == 1){

			$producto = DB::table('luagares_rifas')
                    ->join('wp_posts', 'wp_posts.ID', '=', 'luagares_rifas.id_producto')
                    ->where('luagares_rifas.id', $id)
					->first();

			//return (array)$producto;

	        return view('admin.ver-boleto',compact('producto'));
        }else{
            return redirect('/mx');
        }
    }

    public function verSaldo($id){
        if(Auth::user()->tipo == 1){

            $saldo = DB::table('vendor_ventas')
                    ->where('id', $id)
                    ->first();

            //return (array)$producto;
            return view('admin.ver-saldo',compact('saldo'));
        }else{
            return redirect('/mx');
        }
    }

    public function subirComprobanteSaldo(Request $request){


        if(Auth::user()->tipo == 1){

            $redirect = "/ver-saldo/". $request->id_saldo;
              
            if($request->hasFile('comprobante')){
                $lugar = 'public';
                $lugar = $lugar.'/socio'. $request->id_socio;
                $ruta_deposito = $lugar.'/saldos';




                $saldo = VendorVenta::find($request->id_saldo);

                // si existe eliminarlo y reemplazarlo
                if($saldo->url_pago != null){
                    File::delete($saldo->url_pago);
                    $saldo->url_pago = $request->file('comprobante')->store($ruta_deposito);

                }else{
                    $saldo->url_pago = $request->file('comprobante')->store($ruta_deposito);
                }

                $saldo->estado = 1;
                $saldo->save();

                return redirect($redirect);

            }

            return redirect($redirect);

        }else{
            return redirect('/mx');
        }
    }

    public function descargarComprobanteSaldo($id){
        if(Auth::user()->tipo == 1){
            $saldo = VendorVenta::find($id);
            return Storage::download($saldo->url_pago);
        }else{
            return redirect('/mx');
        }
    }
    




}
