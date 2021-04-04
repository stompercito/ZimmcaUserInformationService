<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return redirect('mx');
    //return view('welcome');
});

Auth::routes();


Route::get('/home', function () {
	return redirect('/partner/dashboard');

});

// pagina de muestra

// Route::get('/prueba', function () {
// 	return view('vendedor.layouts.prueba');

// });

// ************************ Administrador ******************************************************

Route::middleware(['auth'])->group(function () {
	Route::get('/crear-boletos', 'LuagaresRifaController@index')->name('boletos.crear');
	Route::post('/crear-boletos/store/{id}', 'LuagaresRifaController@store')->name('boletos.store');

	Route::get('/nuevas-solicitudes', 'AdminController@indexSolicitudes');
	Route::get('/usuarios', 'AdminController@verUsuarios');
	Route::get('/ver-usuario/{id}', 'AdminController@verUsuario');
	Route::get('/generar-url/{id}', 'AdminController@generarUrl');
	Route::get('/cambiar-estado/{id}', 'AdminController@cambiarEstado');
	Route::get('/desactivar-usuario/{id}', 'AdminController@desactivarUsuario');
	Route::get('/cambiar-nivel-linea/{id}', 'AdminController@cambiarNivelLinea');
	Route::get('/cambiar-nivel-compra/{id}', 'AdminController@CambiarNivelCompra');

	Route::get('/compras/', 'AdminController@indexCompras');
	Route::get('/ver-compra/{id}', 'AdminController@verCompra');

	Route::get('/descargar-comprobante/{id}', 'AdminController@descargarComprobante');
	Route::get('/autorizar-compra/{id}', 'AdminController@autorizarCompra');


	Route::get('/ver-saldo/{id}', 'AdminController@verSaldo');
	Route::post('/subir-comprobante-saldo/', 'AdminController@subirComprobanteSaldo');
	Route::get('/descargar-comprobante-saldo/{id}', 'AdminController@descargarComprobanteSaldo');


	Route::get('/boletos/{id}', 'AdminController@indexBoletos');
	Route::get('/ver-boleto/{id}', 'AdminController@verBoleto');


	Route::get('/dashboard', 'AdminController@index');
	// Avisos 
	Route::get('/avisos', 'AvisosController@index');
	Route::get('/avisos/create', 'AvisosController@create');
	Route::post('/avisos/store', 'AvisosController@store');
	Route::get('/avisos/edit/{id}', 'AvisosController@edit');
	Route::post('/avisos/update', 'AvisosController@update');
	Route::get('/avisos/delete/{id}', 'AvisosController@delete');


	Route::get('/manuales', 'ManualesController@index');
	Route::post('/manuales/store/venta-linea', 'ManualesController@venta_linea');
	Route::post('/manuales/store/venta-compra', 'ManualesController@venta_compra');

	Route::get('/manuales/borrar/{id}', 'ManualesController@borrarManual');

	Route::get('/manuales/descargar-linea/{id}', 'ManualesController@descargarManualLinea');
	Route::get('/manuales/descargar-compra/{id}', 'ManualesController@descargarManualCompra');




});





// ************************** Fin Administrador ************************************************





// *************************** API **************************************************************
// Funcion como de api para obtner y llenar opciones del checkout 
Route::get('/obtener-disponibles', 'LuagaresRifaController@show');
Route::post('/llenar-disponibles', 'LuagaresRifaController@update');
Route::get('/khlfudgthr','LuagaresRifaController@getToken');

// Obtener o crear Slug 
Route::get('/client-slug', 'ClientSlugController@verificarSlugCliente');

// Registrar boleto desde myaccaount de woocommerce
Route::get('/ticket-register', 'LuagaresRifaController@registrarBoleto');

// *************************** Fin API **********************************************************





// **************************** Usuario de Woocommercer *****************************************
// Cambiar los boletos
Route::get('cambiar-boletos/{id}', 'LuagaresRifaController@edit');
Route::get('seleccionar-boletos/{id}/{boleto}', 'LuagaresRifaController@create');

// Cambio de boleto
Route::post('/cambio-boleto', 'LuagaresRifaController@cambioDeBoleto');

// ************************* FIN Usuario Woocommerce **********************************************









// ***************************** Publicas ********************************************************

// Route::get('/first-register', 'VendorController@firstRegister');
// Route::post('/first-register/save', 'VendorController@firstRegisterSave')->name('vendor.partial');
// Route::get('/first-register/review', 'VendorController@firstRegisterReview')->name('vendor.review');
// Route::get('/first-register/review', 'VendorController@firstRegisterReview')->name('vendor.review');

Route::get('/join-us', 'VendorController@trabajaConNosotros')->name('vendor.review');

// ****************************** FIN Publicas *******************************************************



// ********************************** Socio **************************************************************

Route::middleware(['auth'])->group(function () { 

// Panel adminisracion 
Route::get('/partner/dashboard', 'VendorController@dasboard');
Route::get('/partner/sales', 'VendorController@ventasIndex');
Route::get('/partner/sales-online', 'VendorController@ventasOnline');
Route::get('/partner/sales-vendor', 'VendorController@ventasVendor');
Route::get('/partner/review', 'VendorController@revisionSolicitud');
Route::get('/partner/my-account', 'VendorController@miCuenta');
Route::post('/partner/my-account/edit', 'VendorController@miCuentaEditar');
Route::get('/partner/help', 'VendorController@ayudaIndex');
Route::get('/partner/info-earn', 'VendorController@indexComisionesInternas');


// Compras de boletos de los vendedores 

Route::get('/partner/tickets', 'BoletosVendorController@boletosCompradosIndex');
Route::get('/download/ticket/{slug}', 'BoletosVendorController@descargarBoleto');
Route::get('/partner/balance', 'VendorController@saldosIndex');
Route::get('/partner/download-voucher/{id}', 'VendorController@descargarVoucherCliente');

// Compra de boletos por parte de los socios
Route::get('/partner/buy-tickets', 'BoletosVendorController@index');
Route::get('/partner/buy-tickets/{id}', 'BoletosVendorController@show')->name('buy.select');
Route::post('/partner/buy-tickets/summary', 'BoletosVendorController@store')->name('buy.summary');
Route::post('/partner/buy-tickets/save', 'BoletosVendorController@compraBoletosVendedor');

});

// *************************** Fin Socio ****************************************************************

// Route::get('/pruebapdf/{id}', 'BoletosVendorController@pruebapdf');

// Route::get('/pruebapdfvista/', function () {
// 	return view('pdf.prueba');

// });


// Route::get('/mail', 'MailController@pruebaEmail');





















