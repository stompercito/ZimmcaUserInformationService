<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientSlug;
use Illuminate\Support\Facades\DB;

class ClientSlugController extends Controller
{
    public function verificarSlugCliente(Request $request){

    	$usuario = DB::table('wp_users')
            ->where([
                ['ID', '=', $request->cliente],
                ['user_pass', '=', $request->ref],
             ])
            ->first();

         if($usuario != null){
         	$consulta_slug = DB::table('client_slugs')
	            ->where('id_cliente',$usuario->ID)
	            ->first();
	        if($consulta_slug == null){
	        	$slug = new ClientSlug;
	        	$slug->id_cliente = $usuario->ID;
	        	$slug->slug = substr(md5(uniqid(rand())), 0, 8);
	        	$slug->save();

	        	return $slug->slug;

	        }else{
	        	return $consulta_slug->slug;
	        }
         }

    	return $request;

    }
}
