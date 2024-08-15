<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\Exportable;
use App\venta_inventarios;
use DB;

class CombustibleExport implements FromQuery
{

    use Exportable;



    private $fecha1;
    private $fecha2;

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

    public function headings(): array
    {
        return [
            'ID',
            'MES',
            'AÑO',
            'FECHA',
            'CODIGO',
            'ARTICULO',
            'CANTIDAD',
            'PRECIO',
            'TOTAL',
            'KILOMETRAJE',
            'HOROMETRO',
        ];
    }


    public function query()
    {

            return $ventas = venta_inventarios::select('id','fecha','venta')
            ->orderBy('fecha')
            
            ;


    }
}
