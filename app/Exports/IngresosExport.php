<?php

namespace App\Exports;

use App\Models\Ingresos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IngresosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Ingresos::select(
            "paciente_id",
            "ingreso_dia",
            "ingreso_mes",
            "ingreso_año",
            "ingreso_hora",
            "diagnostico",
            "id_servicio",
            "id_cama"
        )->get();
    }
    /**
     * Define las cabeceras del archivo.
     */
    public function headings(): array
    {
        return [
            "paciente_id",
            "ingreso_dia",
            "ingreso_mes",
            "ingreso_año",
            "ingreso_hora",
            "diagnostico",
            "id_servicio",
            "id_cama",
        ];
    }
}
