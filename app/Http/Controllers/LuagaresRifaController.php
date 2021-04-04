<?php

namespace App\Http\Controllers;

use App\LuagaresRifa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use DateTime;
use Illuminate\Support\Facades\Auth;
class LuagaresRifaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->tipo == 1){
            $productos = DB::table('wp_posts')
                ->where('post_type', 'product')
                ->get();

            return view('crear-boletos',compact('productos'));
        }else{
            return redirect('/mx');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($userSlug, $boletoSlug)
    {

        $client_slug = DB::table('client_slugs')
        ->where('slug', $userSlug)
        ->first();


        $user = DB::table('wp_users')
        ->where('ID', $client_slug->id_cliente)
        ->first();


        // Verificar si el usuario existe para poder visualizar la ruta 
        if($user != null) {
            $boletoPorCambiar = DB::table('luagares_rifas')
                ->join('wp_posts', 'wp_posts.ID', '=', 'luagares_rifas.id_producto')
                ->where('luagares_rifas.code', $boletoSlug)
                ->first();

            if($boletoPorCambiar->estado_orden != null){
                $url = 'cambiar-boletos/'. $userSlug;
                return redirect($url);
            }

            $boletos = DB::table('luagares_rifas')
               // ->join('wp_posts', 'wp_posts.ID', '=', 'luagares_rifas.id_producto')
                ->where('luagares_rifas.id_producto', $boletoPorCambiar->ID)
                ->get();

            return view('boletos.edit',compact('user','boletos','boletoPorCambiar','userSlug'));
        }else{
            return redirect('mx');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {

        if(Auth::user()->tipo == 1){
            $count = LuagaresRifa::where('id_producto', $id)->count();

            $precio = DB::table('wp_postmeta')
                    ->where([
                        ['post_id', '=', $id],
                        ['meta_key', '=', '_regular_price'],
                    ])->first();




            if($count != 100){
                for ($i=1; $i<=100; $i++){
                    $lugar = new LuagaresRifa;
                    $lugar->id_producto = $id;
                    $lugar->numero = $i; 
                    $lugar->estado = 0;
                    //Encriptar para el slug
                    $encriptado =  bcrypt($i);
                    $lugar->slug = str_replace("/","p",$encriptado);
                    $lugar->code = substr(md5(uniqid(rand())), 0, 8);
                    $lugar->precio_publico = $precio->meta_value;
                    $lugar->save();
                }
            }

            return redirect('/crear-boletos')->with('message', 'Login Failed');
        }else{
            return redirect('/mx');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LuagaresRifa  $luagaresRifa
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //Extrae el arreglo del json
        //$request->carrito;

        $myArray = array();

        // Obtner lugares disponibles
        for($i =0; $i < sizeof($request->carrito); $i++){
            $producto = $request->carrito[$i];
            $lugares = DB::table('luagares_rifas')
                ->where([
                    ['id_producto', '=', $producto["id"]],
                    ['estado', '=', 0],
                ])->get();

            //Obtner la cantidad del cliente
            for($j=0;$j < $producto["cantidad"]; $j++ ){
                $tempArr  = (array) $lugares[$j];
                $tempArr["nombre"] = $producto["nombre"];
                array_push($myArray, $tempArr);
            }

        }

        return $myArray;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LuagaresRifa  $luagaresRifa
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {

        $client_slug = DB::table('client_slugs')
        ->where('slug', $slug)
        ->first();


        $user = DB::table('wp_users')
        ->where('ID', $client_slug->id_cliente)
        ->first();

        // Verificar si el usuario existe para poder visualizar la ruta 
        if($user != null) {

            $boletos = DB::table('luagares_rifas')
                ->join('wp_posts', 'wp_posts.ID', '=', 'luagares_rifas.id_producto')
                ->where('luagares_rifas.cliente', $user->user_email)
                ->get();

            return view('boletos.index',compact('user','boletos','client_slug'));
        }else{
            return redirect('mx');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LuagaresRifa  $luagaresRifa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        //return json_decode($request->boletos);

        $boletos = json_decode($request->boletos);

        for($i =0; $i < sizeof($boletos); $i++){
            $boletoPorConfirmar = $boletos[$i];
            $boleto = LuagaresRifa::find($boletoPorConfirmar->id);
            $boleto->vendedor = $request->vendedor; 
            $boleto->cliente = $request->cliente;
            $boleto->estado = 1;
            $boleto->modo_venta = 'linea';
            $boleto->save();
        }


        return "todo un exiot";


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LuagaresRifa  $luagaresRifa
     * @return \Illuminate\Http\Response
     */
    public function destroy(LuagaresRifa $luagaresRifa)
    {
        //
    }

    public function getToken(){

        return csrf_token();

    }

    public function cambioDeBoleto(Request $request){

        //return $request;

        $url = 'cambiar-boletos/'. $request->ref;

        if($request->boleto_nuevo_id != ''){
            // Boleto Anterior
            $boletoAnterior = LuagaresRifa::find($request->boleto_anterior_id);
            $boletoAnterior->estado = 0;
            $boletoAnterior->cliente = null;


            // Variable por si tiene vendedor
            $vendedortemp;
            if($boletoAnterior->vendedor != null){
                $vendedortemp = $boletoAnterior->vendedor;
                $boletoAnterior->vendedor = null;
            }else{
                $vendedortemp = null;
            }

            //  id_cliente
            $id_clientetemp;
            if($boletoAnterior->id_cliente != null){
                $id_clientetemp = $boletoAnterior->id_cliente;
                $boletoAnterior->id_cliente = null;
            }else{
                $id_clientetemp = null;
            }

            //  modo_venta
            $modo_venta_temp;
            if($boletoAnterior->modo_venta != null){
                $modo_venta_temp = $boletoAnterior->modo_venta;
                $boletoAnterior->modo_venta = null;
            }else{
                $modo_venta_temp = null;
            }

            //  estado_cliente
            $estado_cliente_temp;
            if($boletoAnterior->estado_cliente != null){
                $estado_cliente_temp = $boletoAnterior->estado_cliente;
                $boletoAnterior->estado_cliente = null;
            }else{
                $estado_cliente_temp = null;
            }


            //  precio_vendedor
            $precio_vendedor_temp;
            if($boletoAnterior->precio_vendedor != null){
                $precio_vendedor_temp = $boletoAnterior->precio_vendedor;
                $boletoAnterior->precio_vendedor = null;
            }else{
                $precio_vendedor_temp = null;
            }


           // orden_id
            $orden_id_temp;
            if($boletoAnterior->orden_id != null){
                $orden_id_temp = $boletoAnterior->orden_id;
                $boletoAnterior->orden_id = null;
            }else{
                $orden_id_temp = null;
            }

             // estado_orden
            $estado_orden_temp;
            if($boletoAnterior->estado_orden != null){
                $estado_orden_temp = $boletoAnterior->estado_orden;
                $boletoAnterior->estado_orden = null;
            }else{
                $estado_orden_temp = null;
            }


            //Nuevo Boleto
            $boletoNuevo = LuagaresRifa::find($request->boleto_nuevo_id);
            $boletoNuevo->estado = 1;
            $boletoNuevo->cliente = $request->usuario_correo;
            $boletoNuevo->vendedor = $vendedortemp;
            $boletoNuevo->id_cliente = $id_clientetemp;
            $boletoNuevo->modo_venta = $modo_venta_temp;
            $boletoNuevo->estado_cliente = $estado_cliente_temp;
            $boletoNuevo->precio_vendedor = $precio_vendedor_temp;
            $boletoNuevo->orden_id = $orden_id_temp;
            $boletoNuevo->estado_orden = $estado_orden_temp;


            //Guardar Boletos
            $boletoAnterior->save();
            $boletoNuevo->save();



            return redirect($url);
        }else{
            return redirect($url);
        }
    }


    public function registrarBoleto(Request $request){

        $boleto = DB::table('luagares_rifas')
            ->join('wp_posts', 'wp_posts.ID', '=', 'luagares_rifas.id_producto')
            ->join('wp_postmeta', 'wp_posts.ID', '=', 'wp_postmeta.post_id')
            ->where('luagares_rifas.code', $request->boleto)
            ->first();

        if($boleto != null){
            if($boleto->estado_cliente == null){

                $user = DB::table('wp_users')
                ->where('ID', $request->cliente)
                ->first();

                $boleto_rifa = LuagaresRifa::find($boleto->id);

                // Guardar informacion del boleto 
                $boleto_rifa->id_cliente = $request->cliente;
                $boleto_rifa->cliente = $user->user_email;
                $boleto_rifa->modo_venta = 'fisico';
                $boleto_rifa->estado_cliente = 1;
                $boleto_rifa->save();


                 date_default_timezone_set('America/Mexico_City');
                $d = new DateTime();
                //echo $d->format('Y-m-d H:i:s');

                // Crear la orden de compra
                $id_post = DB::table('wp_posts')->insertGetId(
                    [
                        'post_author' => 1, 
                        'post_date' => $d->format('Y-m-d H:i:s'),
                        'post_date_gmt' => $d->format('Y-m-d H:i:s'),
                        'post_content' => "",
                        'post_title' => "",
                        'post_excerpt' => 'Boleto # [' . $boleto->numero . '] para rifa de "' . $boleto->post_title . '"',
                        'post_status' => 'wc-completed',
                        'comment_status' => 'closed',
                        'ping_status' => 'closed',
                        'post_password' => "",
                        'post_name' => "",
                        'to_ping' => "",
                        'pinged' => "",
                        'post_modified' => $d->format('Y-m-d H:i:s'),
                        'post_modified_gmt' => $d->format('Y-m-d H:i:s'),
                        'post_content_filtered' => '',
                        'post_parent' => 0,
                        'guid' => "",
                        'menu_order' => 0,
                        'post_type' => 'shop_order',
                        'post_mime_type' => '',
                        'comment_count' => 2,
                    ],

                );

                // Solo es una porque es un boleto
                $id_order_item = DB::table('wp_woocommerce_order_items')->insertGetId([
                        'order_item_name' => $boleto->post_title, 
                        'order_item_type' => 'line_item',
                        'order_id' => $id_post,
                ]);


                $id_order_item_meta1 = DB::table('wp_woocommerce_order_itemmeta')->insertGetId([
                        'order_item_id' => $id_order_item, 
                        'meta_key' => '_product_id',
                        'meta_value' => $boleto->id_producto,
                ]);

                $id_order_item_meta2 = DB::table('wp_woocommerce_order_itemmeta')->insertGetId([
                        'order_item_id' => $id_order_item, 
                        'meta_key' => '_qty',
                        'meta_value' => 1,
                ]);


                $id_order_item_meta3 = DB::table('wp_woocommerce_order_itemmeta')->insertGetId([
                        'order_item_id' => $id_order_item, 
                        'meta_key' => '_line_subtotal',
                        'meta_value' => (int)$boleto->precio_publico,
                ]);


                $id_order_item_meta4 = DB::table('wp_woocommerce_order_itemmeta')->insertGetId([
                        'order_item_id' => $id_order_item, 
                        'meta_key' => '_line_total',
                        'meta_value' => (int)$boleto->precio_publico,
                ]);


                $id_postmeta1 = DB::table('wp_postmeta')->insertGetId([
                        'post_id' => $id_post, 
                        'meta_key' => '_customer_user',
                        'meta_value' => $request->cliente,
                ]);

                $id_postmeta2 = DB::table('wp_postmeta')->insertGetId([
                        'post_id' => $id_post, 
                        'meta_key' => '_payment_method',
                        'meta_value' => 'cod',
                ]);
                $id_postmeta3 = DB::table('wp_postmeta')->insertGetId([
                        'post_id' => $id_post, 
                        'meta_key' => '_payment_method_title',
                        'meta_value' => 'Compra',
                ]);
                $id_postmeta4 = DB::table('wp_postmeta')->insertGetId([
                        'post_id' => $id_post, 
                        'meta_key' => '_order_total',
                        'meta_value' => $boleto->precio_publico,
                ]);

                return "0";
            }else{
                return "1";
            }
        }else{
            return "2";
        }

        
    }
}
