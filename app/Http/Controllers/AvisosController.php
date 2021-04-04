<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Avisos;

class AvisosController extends Controller
{
    public function index(){
    	if(Auth::user()->tipo == 1){
    		$avisos = DB::table('avisos')
                ->get();
            return view('admin.avisos.index',compact('avisos'));
        }else{
            return redirect('/mx');
        }
    }

    public function create(){
    	if(Auth::user()->tipo == 1){
            return view('admin.avisos.create');
        }else{
            return redirect('/mx');
        }
    }

    public function store(Request $request){
    	if(Auth::user()->tipo == 1){
            $aviso = new Avisos;
	    	$aviso->titulo = $request->titulo;
	    	$aviso->aviso = $request->aviso;
	    	$aviso->dia = $request->dia;
	    	$aviso->mes = $request->mes;
	    	$aviso->anio = $request->anio;

	    	$aviso->save();

	    	return redirect('/avisos');
        }else{
            return redirect('/mx');
        }
    }

    public function edit($id){

    	if(Auth::user()->tipo == 1){
            $aviso = Avisos::find($id);

    		return view('admin.avisos.edit',compact('aviso'));
        }else{
            return redirect('/mx');
        }
 
    }

    public function update(Request $request){
    	if(Auth::user()->tipo == 1){
            $aviso = Avisos::find($request->id);
	    	$aviso->titulo = $request->titulo;
	    	$aviso->aviso = $request->aviso;
	    	$aviso->dia = $request->dia;
	    	$aviso->mes = $request->mes;
	    	$aviso->anio = $request->anio;

	    	$aviso->save();

	    	return redirect('/avisos');
        }else{
            return redirect('/mx');
        }
    }

    public function delete($id){
    	if(Auth::user()->tipo == 1){
            $aviso = Avisos::find($id);
	    	$aviso->delete();

	    	return redirect('/avisos');
        }else{
            return redirect('/mx');
        }
    }
}
