<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\UserController;
use App\Exports\UsersExport;
use App\Exports\VentaExport;
use App\Exports\CompraExport;
use App\Exports\ItemscExport;
use App\Exports\ItemsExport;
use App\Exports\CategoriasExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

Route::group(['prefix'=>'api'],function(){

    Route::post('/login', 'UserController@login');
    Route::get('users/export/', function () {

        return (new UsersExport)->download('users.xlsx');
    });
    Route::get('users/export/', function () {

        return (new UsersExport)->nombre(request('nombre'))->download('users.xlsx');
    });
    Route::get('venta/export/', function () {

        return (new VentaExport)->empresa(request('empresa'))->buscar(request('buscar'))->sucursal(request('sucursal'))->fecha1(request('fecha1'))->fecha2(request('fecha2'))->download('ventas.xlsx');
    });
    Route::get('compra/export/', function () {

        return (new CompraExport)->criterio(request('criterio'))->buscar(request('buscar'))->fecha1(request('fecha1'))->fecha2(request('fecha2'))->download('ventas.xlsx');
    });
    Route::get('categoria/export/', function () {

        return (new CategoriasExport)->categoria(request('categoria'))->fecha1(request('fecha1'))->fecha2(request('fecha2'))->download('vcategoria.xlsx');
    });
    Route::get('itemsv/export/', function () {

        return (new ItemsExport)->criterio(request('criterio'))->buscar(request('buscar'))->fecha1(request('fecha1'))->fecha2(request('fecha2'))->download('vproductos.xlsx');
    });
    Route::get('itemsc/export/', function () {

        return (new ItemscExport)->criterio(request('criterio'))->buscar(request('buscar'))->fecha1(request('fecha1'))->fecha2(request('fecha2'))->download('vproductos.xlsx');
    });
    //Trabajadores
    Route::apiResource('/liquidaciones', 'LiquidacionController');
    Route::apiResource('/tPermRoles', 'TPermRoleController');
    Route::apiResource('/tPeriodoTrabajadores', 'TPeriodoTrabajadoreController');
    Route::apiResource('/rContratos', 'RContratoController');
    Route::apiResource('/rInasistencias', 'RInasistenciaController');
    Route::apiResource('/archivos', 'ArchivoController');
    Route::apiResource('/rFacturaciones', 'RFacturacioneController');
    Route::apiResource('/respaldos', 'RespaldoController');
    Route::apiResource('/tSexos', 'TSexoController');
    Route::apiResource('/tNacionalidades', 'TNacionalidadeController');
    Route::apiResource('/tEstadoCiviles', 'TEstadoCivileController');

    Route::apiResource('/sControles', 'SControleController');
    Route::apiResource('/sCentros', 'SCentroController');
    Route::apiResource('/tPermRoles', 'TPermRoleController');

    //Remuneraciones
    Route::apiResource('/rTipoInasistencias', 'RTipoInasistenciaController');

    Route::apiResource('/rCAsistencias', 'RCAsistenciaController');

    Route::apiResource('/menus', 'MenuController');

    Route::apiResource('/rdoccontratos', 'RDocContratoController');
    Route::apiResource('/rtipocontratos', 'RTipoContratoController');

    //
    Route::apiResource('/tPPrevisiones', 'TPPrevisioneController');
    //Procesos Remuneraciones
    Route::apiResource('/rLibros', 'RLibroController');
    Route::apiResource('/rDetalleLibros', 'RDetalleLibroController');


    Route::apiResource('/tipoArchivos', 'TipoArchivoController');
    Route::apiResource('/anos', 'AnoController');
    Route::apiResource('/meses', 'MeseController');

    //Empresas
    Route::apiResource('/tRepresentantes', 'TRepresentanteController');
    Route::apiResource('/tSocios', 'TSocioController');

    Route::apiResource('/templates', 'TemplateController');

    //Cargas Automaticas
    Route::apiResource('/tImpAutomaticos', 'TImpAutomaticoController');
    Route::apiResource('/tRemuAutomaticos', 'TRemuAutomaticoController');

    //Confiduraciones
    Route::apiResource('/tPeriodos', 'TPeriodoController');
    Route::apiResource('/eProcesos', 'EProcesoController');
    Route::apiResource('/areas', 'AreaController');

    //Tipo de Pagos Legales
    Route::apiResource('/tImpuestos', 'TImpuestoController');
    
    Route::apiResource('/tipoImpuestos', 'TipoImpuestoController');
    Route::apiResource('/tipoPagosLegales', 'TipoPagosLegaleController');
    Route::apiResource('/tTipoHonorarios', 'TTipoHonorarioController');
    Route::apiResource('/tTipoIngresos', 'TTipoIngresoController');

    //Configuraciones Gestion del Contador
    Route::apiResource('/tPRemuneraciones', 'TPRemuneracioneController');
    Route::apiResource('/tPagoImpuestos', 'TTPagoImpuestoController');
    Route::apiResource('/tTareas', 'TTareaController');

    Route::apiResource('/tPrevisiones', 'TPrevisioneController');
    Route::apiResource('/tSaludes', 'TSaludeController');
    //Gestion del Contador
    Route::apiResource('/tPagoImpuestos', 'TPagoImpuestoController');
    Route::apiResource('/tGIngresos', 'TGIngresoController');
    Route::apiResource('/tGHonorarios', 'TGHonorarioController');
    Route::apiResource('/tGRemuneraciones', 'TGRemuneracioneController');

    Route::apiResource('/facturaciones', 'FacturacioneController');
    Route::apiResource('/testadopagos', 'TEstadoPagoController');
    Route::apiResource('/empresas', 'EmpresaController');
    Route::apiResource('/trabajadors', 'TrabajadorController');
    Route::get('/liquidacionDocts/liquidacion', 'LiquidacionDoctoController@show');
    Route::get('/ventas/clientes', 'VentaController@ventasCliente');
    Route::get('/ventas/clientest', 'VentaController@tventasCliente');
    Route::get('/ventas/itemventas', 'VentaController@ventaProductos');
    Route::get('/compras/itemcompras', 'CompraController@compraProductos');
    Route::apiResource('/users', 'UserController');
    Route::apiResource('/usersEmpresa', 'UserEmpresaController');
    Route::apiResource('/usersSucursal', 'UserSucursalController');
    Route::apiResource('/paises', 'PaisController');
    Route::apiResource('/roles', 'RoleController');
    Route::get('/region/filtro', 'RegionController@Filtro');
    Route::apiResource('/regiones', 'RegionController');
    Route::apiResource('/comunas', 'ComunaController');
    Route::get('/comuna/filtro', 'ComunaController@Filtro');
    Route::apiResource('/ciudades', 'CiudadController');
    Route::get('/ciudad/filtro', 'CiudadController@Filtro');
    
    Route::apiResource('/clientes', 'ClienteController');
    Route::apiResource('/ccontables', 'CuentaController');
    Route::apiResource('/proveedors', 'ProveedorController');
    Route::apiResource('/bodegas', 'BodegaController');
    Route::get('/bodega/selectBodega','BodegaController@selectBodega');
    Route::apiResource('/marcas', 'MarcaController');
    Route::apiResource('/medidas', 'MedidaController');
    Route::apiResource('/categorias', 'CategoriaController');
    Route::apiResource('/items', 'ItemController');
    
    Route::apiResource('/bodegaarticulos', 'BodegaArticuloController');
    Route::get('/inventarios/kardex/{articulo}', 'InventarioController@kardex');
    Route::get('/inventarios/kardex2/{bodega}', 'InventarioController@kardex2');
    Route::get('/tesorerias/pagos/{cliente}', 'TesoreriaController@pagos');
    Route::apiResource('/inventarios', 'InventarioController');
    Route::apiResource('/compras', 'CompraController');
    Route::apiResource('/ventas', 'VentaController');
    Route::apiResource('/pedidodetalles', 'PedidoDetalleController');
    Route::apiResource('/pedidos', 'PedidoController');
    Route::apiResource('/traspasos', 'TraspasoController');
    Route::apiResource('/sucursals', 'SucursalController');
    Route::apiResource('/documentos', 'DocumentoController');
    Route::apiResource('/metodos', 'MetodoController');
    Route::apiResource('/impuestos', 'ImpuestoController');
    Route::apiResource('/centros', 'CentroController');
    Route::apiResource('/tesorerias', 'TesoreriaController');
    Route::apiResource('/familiacentros', 'FamiliaCentroController');
    Route::apiResource('/tesorerias', 'TesoreriaController');
    

});

Route::get('storage',function(){
    Artisan::call('storage:link');
});




Route::get('/', function () {
    return view('welcome');
});