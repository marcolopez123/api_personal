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

class CategoriasExport implements FromView

{
    use Exportable;

    private $categoria;
    private $fecha1;
    private $fecha2;
    private $date;

    public function categoria($categoria)
    {
        $this->categoria = $categoria;

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
         return view('export.categorias',[
            'categorias' => DB::table('inventarios')->leftjoin('articulos', 'inventarios.articulo_id', '=', 'articulos.id')
            ->leftjoin('categorias', 'articulos.categoria_id', '=', 'categorias.id')
            ->leftjoin('medidas', 'articulos.medida_id', '=', 'medidas.id')
            ->select('inventarios.fecha as fecha','inventarios.articulo_id as id_articulo','medidas.nombre as nombre_medida','articulos.nombre as nombre_articulo','articulos.categoria_id as nombre_categoria',DB::raw('SUM(inventarios.cantidad) as cantidad'),DB::raw('SUM((inventarios.venta)*(inventarios.cantidad)) as total'),DB::raw('SUM(((inventarios.venta)*(inventarios.cantidad))/(cantidad)) as promedio'))
            ->where('inventarios.estado',1)
            ->where('inventarios.tipo',2)
            ->where('articulos.categoria_id',$this->categoria)
            ->where('fecha', '>=' , $this->fecha1)
            ->where('fecha', '<=' , $this->fecha2)
            ->groupBy('fecha')
            ->groupBy('nombre_articulo')
            ->groupBy('nombre_categoria')
            ->groupBy('nombre_medida')
            ->groupBy('id_articulo')
            ->get()
        ]);
    }
}
