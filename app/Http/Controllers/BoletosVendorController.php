<?php

namespace App\Http\Controllers;

use App\BoletosVendor;
use App\LuagaresRifa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;
class BoletosVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // compras de boletos de los vendedores 


    // Ventana principal 
    public function index(){

        $productos = DB::table('luagares_rifas')
            ->join('wp_posts', 'wp_posts.ID', '=', 'luagares_rifas.id_producto')
            ->join('wp_postmeta', 'wp_posts.ID', '=', 'wp_postmeta.post_id')
            ->where([
                    ['wp_posts.post_type', '=', 'product'],
                    ['luagares_rifas.estado', '=', 0],
                    ['wp_postmeta.meta_key', '=', '_regular_price'],
                ])
            ->select(DB::raw('wp_posts.ID, wp_posts.post_title, wp_postmeta.meta_value, count(luagares_rifas.id) as user_count'))
            //->select('wp_posts.*','count(luagares_rifas.id)')
            ->groupBy('wp_posts.ID','wp_posts.post_title','wp_postmeta.meta_value')
            ->get();

        $usr = Auth::user();

        $usuario = DB::table('precio_vendors')
            ->where('id_vendedor',$usr->id)
            ->first();

           // return (array)$usuario;

       // return $productos;
        return view('vendedor.panel.comprar-boletos.index',compact('productos','usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //return $request;
        if($request->boletos_id != null){
            $arrBoletos = [];
            $boletos = json_decode($request->boletos_id);

            $boletos_string = $request->boletos_id;

            foreach ($boletos as $valor){
                $producto = DB::table('luagares_rifas')
                    ->join('wp_posts', 'wp_posts.ID', '=', 'luagares_rifas.id_producto')
                    ->join('wp_postmeta', 'wp_posts.ID', '=', 'wp_postmeta.post_id')
                    ->where([
                            ['luagares_rifas.id', '=', $valor],
                            ['luagares_rifas.estado', '=', 0],
                            ['wp_postmeta.meta_key', '=', '_regular_price'],
                    ])->first();
                array_push($arrBoletos, $producto);
            }

            //return $arrBoletos;
        $usr = Auth::user();

        $usuario = DB::table('precio_vendors')
            ->where('id_vendedor',$usr->id)
            ->first();

            return view('vendedor.panel.comprar-boletos.resumen',compact('arrBoletos','usuario','boletos_string'));
        }else{
            return redirect('/partner/buy-tickets');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BoletosVendor  $boletosVendor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $boletos = DB::table('luagares_rifas')
               // ->join('wp_posts', 'wp_posts.ID', '=', 'luagares_rifas.id_producto')
                ->where('luagares_rifas.id_producto', $id)
                ->get();

        $rifa = DB::table('wp_posts')
                ->join('wp_postmeta', 'wp_posts.ID', '=', 'wp_postmeta.post_id')
                ->where('wp_posts.ID', $id)
                ->where([
                    ['wp_posts.ID', '=', $id],
                    ['meta_key', '=', '_regular_price'],
                ])
                //->get();
                ->first();
        //return $rifa;

        //return (array)$rifa;

        return view('vendedor.panel.comprar-boletos.seleccion',compact('boletos','rifa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BoletosVendor  $boletosVendor
     * @return \Illuminate\Http\Response
     */
    public function edit(BoletosVendor $boletosVendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BoletosVendor  $boletosVendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BoletosVendor $boletosVendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BoletosVendor  $boletosVendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(BoletosVendor $boletosVendor)
    {
        //
    }


    public function compraBoletosVendedor(Request $request){


        if($request->hasFile('recibo')){


            $referencia = DB::table('wp_wc_product_meta_lookup')
            ->where('product_id', $request->producto_id)
            ->first();

        $stock_quantity = $referencia->stock_quantity - $request->cantidad_boletos;
        $total_sales = $referencia->total_sales + $request->cantidad_boletos;



        $referencia_total_sales = DB::table('wp_postmeta')
                    ->where([
                            ['post_id', '=', $request->producto_id],
                            ['meta_key', '=', 'total_sales']
                    ])->first();

        $referencia_stock = DB::table('wp_postmeta')
                    ->where([
                            ['post_id', '=', $request->producto_id],
                            ['meta_key', '=', '_stock']
                    ])->first();

        $total_total_sales = $referencia_total_sales->meta_value + $request->cantidad_boletos;
        $total_stock = $referencia_stock->meta_value - $request->cantidad_boletos;



        $stock = DB::table('wp_wc_product_meta_lookup')
                ->where('product_id', $request->producto_id)
                ->update([
                        'stock_quantity' => $stock_quantity,
                        'total_sales' => $total_sales
                ]);


        $total_sales_act = DB::table('wp_postmeta')
                    ->where([
                            ['post_id', '=', $request->producto_id],
                            ['meta_key', '=', 'total_sales']
                    ])
                    ->update([
                        'meta_value' => $total_total_sales
                    ]);

        $stock_act = DB::table('wp_postmeta')
                    ->where([
                            ['post_id', '=', $request->producto_id],
                            ['meta_key', '=', '_stock']
                    ])->update([
                        'meta_value' => $total_stock
                    ]);




            $user = Auth::user();
            // Guardar Nuevo Archivo
            $lugar = 'public';
            $lugar = $lugar.'/socio'. $user->id;
            $ruta_deposito = $lugar.'/depositos';

            // registrar la compra
            $compra = new BoletosVendor;
            $compra->id_vendedor = $user->id;
            $compra->total_compra = $request->total_compra;
            $compra->cantidad_deposito = $request->cantidad;
            $compra->precio_boleto = $request->precio_boleto;
            $compra->cantidad_boletos = $request->cantidad_boletos;
            $compra->ciudad = $request->ciudad;
            $compra->fecha_deposito = $request->fecha_deposito;
            $compra->estado = 0;       
            $compra->url_imagen_depostio = $request->file('recibo')->store($ruta_deposito);
            $compra->save();

            // apartar boletos
            $boletos = json_decode($request->boletos);

            //dd($boletos);

            foreach ($boletos as $boleto){
                $lugar = LuagaresRifa::find($boleto);
                $lugar->estado = 1;
                $lugar->vendedor = $user->id;
                $lugar->precio_vendedor = $request->precio_boleto;
                $lugar->orden_id = $compra->id;
                $lugar->estado_orden = 0;
                $lugar->save();
            }

            return redirect('/partner/tickets'); 

        }else{
            return redirect()->route('/partner/buy-tickets');
        }

    }


    public function boletosCompradosIndex(){


        $user = Auth::user();

        $productos = DB::table('luagares_rifas')
                    ->join('wp_posts', 'wp_posts.ID', '=', 'luagares_rifas.id_producto')
                    ->join('wp_postmeta', 'wp_posts.ID', '=', 'wp_postmeta.post_id')
                    ->where([
                            ['luagares_rifas.vendedor', '=', $user->id],
                            ['luagares_rifas.estado', '=', 1],
                            ['wp_postmeta.meta_key', '=', '_regular_price'],
                    ])->get();


        $id_productos = DB::table('luagares_rifas')
                    ->select('luagares_rifas.id_producto')
                    ->distinct()
                    ->where([
                            ['luagares_rifas.vendedor', '=', $user->id],
                            ['luagares_rifas.estado', '=', 1],
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


        //return $arrTotal;
        return view('vendedor.panel.boletos',compact('arrTotal'));
    }


    public function pruebapdf($id){
        //return $id;
        $pdf = \PDF::loadView('pdf.prueba');
 
        return $pdf->download('archivo.pdf');
    }
    
    public function descargarBoleto($slug) {

        $user = Auth::user();

        $boleto = DB::table('luagares_rifas')
                ->join('wp_posts', 'wp_posts.ID', '=', 'luagares_rifas.id_producto')
                ->where([
                    ['luagares_rifas.code', '=', $slug],

                ])->first();


        //return (array)$boleto;

       // return view('pdf.prueba',compact('slug','user','boleto'));
     //
        $pdf = \PDF::loadView('pdf.prueba',compact('slug','user','boleto'));
        $nombre = $slug . ".pdf";
        return $pdf->download($nombre);


    }



    
}
