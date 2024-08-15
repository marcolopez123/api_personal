<?php

namespace App\Exports;

use App\Models\Compra;
use App\Models\Articulo;
use App\Models\CompraInventario;
use App\Models\Tesoreria;
use App\Models\Inventario;
use App\Models\Proveedor;
use App\Models\Categoria;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\shouldAutoSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemscExport implements FromView

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
         return view('export.itemsc',[
            'itemsc' => 
            DB::table('compra_inventarios')
            ->leftjoin('articulos', 'compra_inventarios.articulo_id', '=', 'articulos.id')
            ->leftjoin('medidas', 'articulos.medida_id', '=', 'medidas.id')
            ->leftjoin('compras', 'compra_inventarios.compra_id', '=', 'compras.id')
            ->leftjoin('proveedors', 'compras.proveedor_id', '=', 'proveedors.id')
            ->select('compra_inventarios.articulo_id as id_articulo','articulos.nombre as nombre_articulo','medidas.nombre as nombre_medida','proveedors.nombre as nombre_proveedor','compras.fecha as fecha','compra_inventarios.cantidad as cantidad','compra_inventarios.neto as neto',DB::raw('((compra_inventarios.neto)*(compra_inventarios.cantidad)) as total'))
            ->where('compra_inventarios.estado',1)
            ->where($this->criterio, 'like' , '%'. $this->buscar . '%')
            ->where('fecha', '>=' , $this->fecha1)
            ->where('fecha', '<=' , $this->fecha2)
            ->get()
        ]);
    }
}
