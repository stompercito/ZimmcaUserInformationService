<?php

namespace App\Http\Controllers;

use App\Vendor;
use Illuminate\Http\Request;
use Redirect;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\VendorVenta;
use App\LuagaresRifa;
use App\Avisos;
use App\PrecioVendor;
use Illuminate\Support\Facades\Storage;
use App\User;

class VendorController extends Controller
{

    public function firstRegister(){

        return view('vendedor.partial-register');

    }

    public function firstRegisterSave(Request $request){
        $vendedor = new Vendor;
        $vendedor->nombre = $request->name;
        $vendedor->correo = $request->email;
        $vendedor->telefono = $request->phone;
        $vendedor->ciudad = $request->city;
        $vendedor->estado = 0;
        $vendedor->save();

        return Redirect::route('vendor.review')->with( ['vendedor' => $vendedor]);

        return view('vendedor.review',compact('vendedor'));
    }

    public function firstRegisterReview(){
        return view('vendedor.review');
    }

    public function dasboard(){

        $usuario = Auth::user();

        $precio = DB::table('precio_vendors')
                ->where('id_vendedor',$usuario->id)
                ->first();

        if($precio == null){
            $precio_vendor = new PrecioVendor;
            $precio_vendor->id_vendedor = $usuario->id;
            $precio_vendor->comision_linea = 0.05;
            $precio_vendor->comision_compra = 0.1;
            $precio_vendor->nivel_linea = "Intermedio";
            $precio_vendor->nivel_compra = "Intermedio";
            $precio_vendor->save();
        }

        // if(Auth::user()->estado == 0){
        //     return redirect('/partner/review');
        // }


        // Top 5 clientes 
        $boletosCliente = DB::table('luagares_rifas')
                ->select(DB::raw('count(*) as num, luagares_rifas.cliente'))
                ->where([
                        ['luagares_rifas.vendedor', '=', $usuario->id],
                        ['luagares_rifas.cliente', '!=', null],
                    ])
                ->groupBy('luagares_rifas.cliente')
                ->orderBy('num', 'desc')
                ->get();

        // Top 5 clientes
        $clientes = [];
        $top5Clientes;

        if(count($boletosCliente)< 5){
           $top5Clientes = $boletosCliente;
        }else{
            for($i =0 ; $i < 5; $i ++){
                array_push($clientes, $boletosCliente[$i]);
            }
            $top5Clientes = $clientes;
        }

        //return $top5Clientes;


        //Boletos vendidos de la rifa 
        $boletosOcupados = DB::table('luagares_rifas')
                ->select(DB::raw('count(*) as ocupados, wp_posts.ID, wp_posts.post_title'))
                ->join('wp_posts', 'wp_posts.ID', '=', 'luagares_rifas.id_producto')
                ->where('luagares_rifas.estado', 1)
                ->groupBy('wp_posts.ID','wp_posts.post_title')
                ->get();

       //return $boletosOcupados;

        $total_boletos_vendidos = DB::table('luagares_rifas')
                                ->where([
                                        ['luagares_rifas.estado', '=', 1],
                                        ['luagares_rifas.cliente', '!=', null],
                                        ['luagares_rifas.vendedor', '=', $usuario->id],
                                    ])
                                ->count();
        //return $total_boletos_vendidos;

        $total_clientes  =  count($boletosCliente);

        $total_boletos_linea =  DB::table('luagares_rifas')
                                ->where([
                                        ['luagares_rifas.estado', '=', 1],
                                        ['luagares_rifas.cliente', '!=', null],
                                        ['luagares_rifas.vendedor', '=', $usuario->id],
                                        ['luagares_rifas.modo_venta', '=', "linea"],
                                    ])
                                ->count();

        //return $total_boletos_linea;

        $total_boletos_fisico =  DB::table('luagares_rifas')
                                ->where([
                                        ['luagares_rifas.estado', '=', 1],
                                        ['luagares_rifas.cliente', '!=', null],
                                        ['luagares_rifas.vendedor', '=', $usuario->id],
                                        ['luagares_rifas.modo_venta', '=', "fisico"],
                                    ])
                                ->count();

        //return $total_boletos_fisico;

        $avisos = DB::table('avisos')
                    ->get();
    
        return view('vendedor.panel.dashboard',compact('boletosOcupados',
                                                        'top5Clientes',
                                                        'total_boletos_vendidos',
                                                        'total_clientes',
                                                        'total_boletos_linea',
                                                        'total_boletos_fisico',
                                                        'avisos'
                                                ));
    }

    public function ventasIndex(){
        return view('vendedor.panel.ventas.index');

    }
    public function ventasOnline(){

        $user = Auth::user();

        $productos = DB::table('luagares_rifas')
                    ->join('wp_posts', 'wp_posts.ID', '=', 'luagares_rifas.id_producto')
                    ->join('wp_postmeta', 'wp_posts.ID', '=', 'wp_postmeta.post_id')
                    ->where([
                            ['luagares_rifas.vendedor', '=', $user->id],
                            ['luagares_rifas.estado', '=', 1],
                            ['wp_postmeta.meta_key', '=', '_regular_price'],
                            ['luagares_rifas.modo_venta', '=', 'linea'],
                    ])->get();


        $id_productos = DB::table('luagares_rifas')
                    ->select('luagares_rifas.id_producto')
                    ->distinct()
                    ->where([
                            ['luagares_rifas.vendedor', '=', $user->id],
                            ['luagares_rifas.estado', '=', 1],
                            ['luagares_rifas.modo_venta', '=', 'linea'],
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

        $usuario = DB::table('precio_vendors')
            ->where('id_vendedor',$user->id)
            ->first();

        //return (array)$usuario;
       // return $arrTotal;
        return view('vendedor.panel.ventas.ventas-linea',compact('arrTotal','usuario'));



       //  $usuario = Auth::user();

       //  $boletos = DB::table('luagares_rifas')
       //          ->join('wp_posts', 'wp_posts.ID', '=', 'luagares_rifas.id_producto')
       //          ->where([
       //              ['luagares_rifas.vendedor', '=', $usuario->id],
       //              ['luagares_rifas.modo_venta', '=', '1'],
       //          ])->get();

       // // return $boletos;

       //  return view('vendedor.panel.ventas.ventas-linea',compact('boletos'));
    }
    public function ventasVendor(){

        $user = Auth::user();

        $productos = DB::table('luagares_rifas')
                    ->join('wp_posts', 'wp_posts.ID', '=', 'luagares_rifas.id_producto')
                    ->join('wp_postmeta', 'wp_posts.ID', '=', 'wp_postmeta.post_id')
                    ->where([
                            ['luagares_rifas.vendedor', '=', $user->id],
                            ['luagares_rifas.estado', '=', 1],
                            ['wp_postmeta.meta_key', '=', '_regular_price'],
                            ['luagares_rifas.modo_venta', '=', 'fisico'],
                    ])->get();


        $id_productos = DB::table('luagares_rifas')
                    ->select('luagares_rifas.id_producto')
                    ->distinct()
                    ->where([
                            ['luagares_rifas.vendedor', '=', $user->id],
                            ['luagares_rifas.estado', '=', 1],
                            ['luagares_rifas.modo_venta', '=', 'fisico'],
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

        $usuario = DB::table('precio_vendors')
            ->where('id_vendedor',$user->id)
            ->first();

        //return $arrTotal;
        return view('vendedor.panel.ventas.ventas-boleto',compact('arrTotal','usuario'));

        return view('vendedor.panel.ventas.ventas-boleto');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }

    public function saldosIndex(){

        $user = Auth::user();

        $productos = DB::table('luagares_rifas')
                    ->join('wp_posts', 'wp_posts.ID', '=', 'luagares_rifas.id_producto')
                    ->join('wp_postmeta', 'wp_posts.ID', '=', 'wp_postmeta.post_id')
                    ->where([
                            ['luagares_rifas.vendedor', '=', $user->id],
                            ['luagares_rifas.estado', '=', 1],
                            ['wp_postmeta.meta_key', '=', '_regular_price'],
                            ['luagares_rifas.modo_venta', '=', 'linea'],
                    ])->get();


        $id_productos = DB::table('luagares_rifas')
                    ->select('luagares_rifas.id_producto')
                    ->distinct()
                    ->where([
                            ['luagares_rifas.vendedor', '=', $user->id],
                            ['luagares_rifas.estado', '=', 1],
                            ['luagares_rifas.modo_venta', '=', 'linea'],
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

        $precio_vendors = DB::table('precio_vendors')
            ->where('id_vendedor',$user->id)
            ->first();


        $arrComisiones = [];
        $total = 0;
        $id_producto = 0;
        $nombre_producto = ""; 

        foreach ($arrTotal as $arr) {
            $arrInfoTotal = [];
            foreach ($arr as $producto) {
                $total += ($producto->precio_publico * $precio_vendors->comision_linea);
                $id_producto = $producto->id_producto;
                $nombre_producto = $producto->post_title;
            }

            array_push($arrInfoTotal, $total);
            array_push($arrInfoTotal, $id_producto);
            array_push($arrInfoTotal, $nombre_producto);

            array_push($arrComisiones, $arrInfoTotal);
            $total = 0;
            $id_producto = 0;
            $nombre_producto = ""; 
        }


        foreach ($arrComisiones as $producto) {

            $venta = DB::table('vendor_ventas')
                    ->where([
                            ['id_vendedor', '=', $user->id],
                            ['id_producto', '=', (int)$producto[1]],
                    ])->first();

            if($venta == null){
                $nueva_venta = new VendorVenta;
                $nueva_venta->id_producto = $producto[1];
                $nueva_venta->nombre_producto = $producto[2];
                $nueva_venta->id_vendedor = $user->id;
                $nueva_venta->total_utilidad = $producto[0];
                $nueva_venta->estado = 0;
                $nueva_venta->nivel_comision = $precio_vendors->nivel_linea;
                $nueva_venta->save();
            }else{
                $venta_editar = VendorVenta::find($venta->id);
                $venta_editar->total_utilidad = $producto[0];
                $venta_editar->save();
            }
  
        }


        $ventas = DB::table('vendor_ventas')
            ->join('wp_posts', 'wp_posts.ID', '=', 'vendor_ventas.id_producto')
            ->where('vendor_ventas.id_vendedor',$user->id)
            ->get();


        
        //return $ventas;
        return view('vendedor.panel.saldos',compact('ventas','user'));






        return "saldos";
    }

    public function revisionSolicitud(){
        return view('vendedor.panel.cuenta-revision');
    }

    public function miCuenta(){

        $user = DB::table('users')
            ->join('precio_vendors', 'precio_vendors.id_vendedor', '=', 'users.id')
            ->where('users.id',Auth::user()->id)
            ->first();

        return view('vendedor.panel.data', compact('user'));
    }

    public function descargarVoucherCliente($id){
        $venta = DB::table('vendor_ventas')
            ->where('id',$id)
            ->first();

        $usuario = Auth::user();

        if($venta->id_vendedor == $usuario->id){
            return Storage::download($venta->url_pago);
        }else{
            return redirect('/partner/balance');
        }
    }

    public function ayudaIndex(){
        return view('vendedor.panel.info');
    }

    public function indexComisionesInternas() {

        return view('comisiones.info-interna'); 
    }


    public function trabajaConNosotros(){
        return view('comisiones.info-externa'); 
    }


    public function miCuentaEditar(Request $request){ 
        //return $request; 
        $usr = User::find(Auth::user()->id);
        $usr->name = $request->nombre;
        $usr->email = $request->email;
        $usr->apellido_paterno = $request->appelido_p;
        $usr->fecha_nacimiento = $request->fecha;
        $usr->direccion = $request->dir;
        $usr->cp = $request->cp;
        $usr->pais = $request->pais;
        $usr->ciudad = $request->ciudad;
        $usr->telefono = $request->tel;
        $usr->tarjeta = $request->tarjeta;
        $usr->save();

        return redirect('/partner/my-account');
    }

}
