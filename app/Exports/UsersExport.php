<?php
namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\shouldAutoSize;
use Illuminate\Http\Request;

class UsersExport implements FromView
{

    use Exportable;

    private $nombre;
    private $date;

    public function nombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
    public function view(): View
    {
         return view('export.users',[
            'users' => User::all()->where('nombre', '=', $this->nombre)
        ]);
    }
}
