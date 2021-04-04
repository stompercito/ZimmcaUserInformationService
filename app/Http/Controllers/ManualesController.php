<?php

namespace App\Http\Controllers;

use App\Manuales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;

class ManualesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manuales = Manuales::all();
        return view('admin.manuales.index',compact('manuales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function venta_linea(Request $request)
    {
        if($request->hasFile('manual_linea')){
            // Guardar Nuevo Archivo
            $lugar = 'public';
            $lugar = $lugar.'/manuales';
            $ruta_deposito = $lugar;

            // registrar la compra
            $compra = new Manuales;
            $compra->ruta_manual =  $request->file('manual_linea')->store($ruta_deposito);
            $compra->nombre = 'Manual ventas en linea v0.';
            $compra->save();

            $act_compra = Manuales::find($compra->id);
            $act_compra->nombre = 'Manual ventas en linea v0.'. $compra->id;

            return redirect('/manuales'); 

        }else{
            return redirect()->route('/manuales');
        }
    }

    public function venta_compra(Request $request)
    {
        //return $request;
        if($request->hasFile('manual_compra')){
            // Guardar Nuevo Archivo
            $lugar = 'public';
            $lugar = $lugar.'/manuales';
            $ruta_deposito = $lugar;

            // registrar la compra
            $compra = new Manuales;
            $compra->ruta_manual =  $request->file('manual_compra')->store($ruta_deposito);
            $compra->nombre = 'Manual ventas compra v0.';
            $compra->save();

            $act_compra = Manuales::find($compra->id);
            $act_compra->nombre = 'Manual ventas compra v0.'. $compra->id;

            return redirect('/manuales'); 

        }else{
            return redirect()->route('/manuales');
        }
    }

    public function borrarManual($id){

        $manual = Manuales::find($id);
        Storage::delete($manual->ruta_manual);
        $manual->delete();

        return redirect('/manuales'); 
    }

    public function descargarManualLinea($id){
        $manual = Manuales::find($id);
        $name = "venta-boletos-linea.pdf";
        return Storage::download($manual->ruta_manual, $name);
    }

        public function descargarManualCompra($id){
        $manual = Manuales::find($id);
        $name = "venta-boletos-compra.pdf";
        return Storage::download($manual->ruta_manual, $name);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manuales  $manuales
     * @return \Illuminate\Http\Response
     */
    public function show(Manuales $manuales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Manuales  $manuales
     * @return \Illuminate\Http\Response
     */
    public function edit(Manuales $manuales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Manuales  $manuales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manuales $manuales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manuales  $manuales
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manuales $manuales)
    {
        //
    }
}
