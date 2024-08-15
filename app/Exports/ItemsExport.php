<?php

namespace App\Exports;

use App\Models\Venta;
use App\Models\Articulo;
use App\Models\VentaInventario;
use App\Models\Tesoreria;
use App\Models\Inventario;
use App\Models\Cliente;
use App\Models\Categoria;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\shouldAutoSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemsExport implements FromView

{
    use Exportable;

    private $fecha1;
    private $fecha2;
    private $buscar;
    private $criterio;

    public function criterio($criterio)
    {
        $this->criterio = $criterio;

        return $this;
    }
    public function buscar($buscar)
    {
        $this->buscar = $buscar;

        return $this;
    }
    public function fecha1($fecha1)
    {
        $this->fecha1 = $fecha1;

        return $this;
    }
    public function fecha2($fecha2)
    {
        $this->fecha2 = $fecha2;

        return $this;
    }
    public function view(): View
    {
         return view('export.itemsv',[
            'itemsv' => DB::table('venta_inventarios')
            ->leftjoin('articulos', 'venta_inventarios.articulo_id', '=', 'articulos.id')
            ->leftjoin('medidas', 'articulos.medida_id', '=', 'medidas.id')
            ->leftjoin('ventas', 'venta_inventarios.venta_id', '=', 'ventas.id')
            ->leftjoin('clientes', 'ventas.cliente_id', '=', 'clientes.id')
            ->select('venta_inventarios.articulo_id as id_articulo','articulos.nombre as nombre_articulo','medidas.nombre as nombre_medida','clientes.nombre as nombre_cliente','ventas.fecha as fecha','venta_inventarios.cantidad as cantidad','venta_inventarios.neto as neto',DB::raw('((venta_inventarios.neto)*(venta_inventarios.cantidad)) as total'))
            ->where('venta_inventarios.estado',1)
            ->where($this->criterio, 'like' , '%'. $this->buscar . '%')
            ->where('fecha', '>=' , $this->fecha1)
            ->where('fecha', '<=' , $this->fecha2)
            ->get()
        ]);
    }
}
