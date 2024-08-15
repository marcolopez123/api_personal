<?php

namespace App\Exports;
use App\Models\Facturacione;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\shouldAutoSize;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\T_estado_pago;
use Illuminate\Support\Facades\DB;

class VentaExport implements FromView
{

    use Exportable;

    private $buscar;
    private $empresa;
    private $sucursal;
    private $fecha1;
    private $fecha2;
    
    public function buscar($buscar)
    {
        $this->buscar = $buscar;

        return $this;
    }
    public function empresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    public function sucursal($sucursal)
    {
        $this->sucursal = $sucursal;

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

          
            return view('export.ventas',[
                'ventas' => DB::table('facturaciones')
                ->leftjoin('clientes', 'facturaciones.cliente_id', '=', 'clientes.id')
                ->leftjoin('t_estado_pagos', 'facturaciones.t_estado_pago_id', '=', 't_estado_pagos.id')
                ->select('t_estado_pagos.nombre as nombre_estado',
                         'facturaciones.cliente_id as id_cliente',
                         'clientes.nombre as nombre_cliente',
                         'facturaciones.fecha as fecha',
                         'facturaciones.nro as nro',
                         'facturaciones.orden as orden',
                         'facturaciones.monto as monto')
                ->where('facturaciones.estado',1)
                ->where('empresa_id','=',$this->empresa)
                ->where('sucursal_id','=',$this->sucursal)
                ->where('clientes.nombre','like' , '%'. $this->buscar . '%')
                ->where('fecha', '>=' , $this->fecha1)
                ->where('fecha', '<=' , $this->fecha2)
                ->get()
       
        ]);
    }
}
