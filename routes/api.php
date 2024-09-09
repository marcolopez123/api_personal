<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Exports\UsersExport;
use App\Exports\VentaExport;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Storage;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/template', 'ArchivoDoctoController@Template');

Route::get('/liquidaciones/{liquidacion}/liquidacion', 'LiquidacionController@descarga');
Route::get('/liquidacionDocts/{liquidaciondocto}/liquidacion', 'LiquidacionDoctoController@descarga');
Route::post('/liquidacionDoct/liquidacion/{liquidacion}', 'LiquidacionDoctoController@store');
Route::get('users/export/', [UserController::class, 'export'])->name('export');

Route::get('/archivos/archivo', 'ArchivoController@trabajador');
Route::get('/archivos/contrato', 'ArchivoController@FiltroContrato');
Route::get('/archivos/registro', 'ArchivoController@FiltroRegistro');
Route::get('/archivos/area', 'ArchivoController@FiltroArea');
Route::get('/rfacturacion/filtro', 'RFacturacioneController@Filtro');
Route::get('/facturaciones/filtro', 'FacturacioneController@Filtro');
Route::get('/facturaciones/filtro2', 'FacturacioneController@Filtro2');
Route::get('/usersEmpresa/usuario', 'UserEmpresaController@Usuario');
Route::get('/usersSucursal/usuario', 'UserSucursalController@Usuario');
Route::get('/usersSucursal/empresa', 'UserSucursalController@Empresa');
Route::get('/sucursal/empresa', 'SucursalController@Empresa');
Route::get('/empresa/filtro', 'EmpresaController@filtro');
Route::get('/area/filtro', 'TipoArchivoController@area');

Route::get('/templates/filtro', 'TemplateController@Filtro');
Route::get('/templates/empresa', 'TemplateController@Empresa');
Route::get('/templates/id', 'TemplateController@id');

Route::get('/rCAsistencias/filtro', 'RCAsistenciaController@Filtro');
Route::get('/rCAsistencias/filtro2', 'RCAsistenciaController@Filtro2');
Route::get('/rCAsistencias/filtroSalida', 'RCAsistenciaController@filtroSalida');
//Trabajadores
Route::get('/tPeriodoTrabajadore/filtro', 'TPeriodoTrabajadoreController@Filtro');
Route::get('/rContrato/filtro', 'RContratoController@Filtro');
Route::get('/rInasistencias/filtro', 'RInasistenciaController@Filtro');
Route::get('/rDetalleLibros/filtro', 'RDetalleLibroController@procesar');

Route::get('/tPPrevisiones/filtro', 'TPPrevisioneController@Filtro');

Route::get('/sControles/filtro', 'SControleController@Filtro');
//Procesos
Route::get('/rLibros/filtro', 'RLibroController@Filtro');
Route::get('/rDetalleLibros/filtro', 'RDetalleLibroController@Filtro');
Route::get('/rDetalleLibros/porcesar', 'RDetalleLibroController@procesar');

Route::get('/rDetalleLibros/liquidacion', 'RDetalleLibroController@liquidacion');

//Gestion del Contador
Route::get('/tPagoImpuesto/filtro', 'TPagoImpuestoController@Filtro');
Route::get('/tPermRoles/filtro', 'TPermRoleController@Filtro');
Route::get('/tGHonorario/filtro', 'TGHonorarioController@Filtro');
Route::get('/tGIngreso/filtro', 'TGIngresoController@Filtro');
Route::get('/tGRemuneracione/filtro', 'TGRemuneracioneController@Filtro');

Route::post('/archivoDoctos/archivo/{archivo}', 'ArchivoDoctoController@store');
Route::post('/respaldoDocto/archivo/{respaldo}', 'RespaldoDoctoController@store');
Route::post('/respaldoFacturaciones/archivo/{rFacturacione}', 'RespaldoFacturacioneController@store');
Route::get('/respaldo/formulario29', 'RespaldoController@Formulario29');
Route::get('/respaldo/prevencion', 'RespaldoController@Prevencion');

Route::post('/fichaImages/trabajador/{trabajador}', 'FichaImageController@store');
Route::get('/dashboard', 'DashboardController@info');
Route::get('/dashboardgas', 'DashboardgasController@info');
Route::get('/ventas/gas', 'VentaController@Gas');
Route::get('/liquidaciones/liquidacion', 'LiquidacionController@trabajador');
Route::get('/liquidaciones/liquidacion2', 'LiquidacionController@trabajador2');
Route::get('/trabajadors/trabajador', 'TrabajadorController@filtro');
Route::get('/trabajadors/empresa', 'TrabajadorController@empresa');
Route::get('/trabajadors/sucursal', 'TrabajadorController@sucursal');
Route::get('/liquidacionDocts/liquidacion/{liquidacion}', 'LiquidacionDoctoController@show');
Route::get('/proveedors/selectProveedor','ProveedorController@selectProveedor');
Route::get('/inventarios/inventario','InventarioController@inventario');
Route::get('/inventarios/categoria','InventarioController@kardex3');
Route::get('/detellepedidos/pedido','PedidoDetalleController@pedidos');
Route::get('/ventas/facturacion','VentaController@facturacion');
Route::get('/ventas/pagosventa','VentaController@pagosventa');
Route::post('/ventas/facton/{venta}', 'VentaController@facton');
Route::get('/reportes/ventas/{venta}', 'VentaController@pdf');
Route::post('/ventas/filter', 'VentaController@filter');
Route::get('/reportes/pedidos/{pedido}', 'PedidoController@pdf');
Route::get('/reportes/ventasgas/{venta}', 'VentaController@pdfgas');
Route::get('/ventas/resumen/', 'VentaController@resumenVentas');
Route::get('/ventas/dia/', 'VentaController@resumenDia');
Route::get('/ventas/categoria/', 'VentaController@ventaCategoria2');
Route::get('/tesorerias/cajadia/', 'TesoreriaController@cajadia');
Route::get('/tesorerias/cajadia2/', 'TesoreriaController@cajadia2');
Route::get('/ventas/mes/', 'VentaController@resumenMes');
Route::get('/ventas/semana/', 'VentaController@resumenSemana');
Route::get('storage',function(){
    Artisan::call('storage:link');
});



//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
