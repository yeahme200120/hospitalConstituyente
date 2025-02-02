<?php

namespace App\Exports;

use App\Models\Diagnosticos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TratamientoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Diagnosticos::select(
            "paciente_id",
            "id_medico",
            "diagnostico_agregado",
            "diagnostico_egreso",
            "laboratorios",
        )->get();
    }
    /**
     * Define las cabeceras del archivo.
     */
    public function headings(): array
    {
        return [
            "paciente_id",
            "id_medico",
            "diagnostico_agregado",
            "diagnostico_egreso",
            "laboratorios",
        ];
    }
}
