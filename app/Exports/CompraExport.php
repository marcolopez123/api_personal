<?php

namespace App\Exports;
use App\Models\Compra;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\shouldAutoSize;
use Illuminate\Http\Request;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;

class CompraExport implements FromView
{

    use Exportable;

    private $fecha1;
    private $fecha2;
    private $date;

    public function nombre($nombre)
    {
        $this->nombre = $nombre;

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
         return view('export.compras',[
            'compras' => compra::where('fecha', '>=' , $this->fecha1)->where('fecha', '<=' , $this->fecha2)->with(['Proveedor'])->get()
        ]);
    }
}

