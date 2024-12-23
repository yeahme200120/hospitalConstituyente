<?php

namespace App\Exports;

use App\Models\Pacientes;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PacientesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pacientes::select(
        "nombre",
        "fecha_nac_dia",
        "fecha_nac_mes",
        "fecha_nac_año",
        "edad",
        "genero",
        "id_enfermedad_cronica",
        "telefono",
        "alergias"
        )->get();
    }
    public function headings(): array
    {
        return [
            "nombre",
            "fecha_nac_dia",
            "fecha_nac_mes",
            "fecha_nac_año",
            "edad",
            "genero",
            "id_enfermedad_cronica",
            "telefono",
            "alergias",
        ];
    }
}
