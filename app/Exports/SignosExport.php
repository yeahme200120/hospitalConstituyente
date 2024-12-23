<?php

namespace App\Exports;

use App\Models\SignosVitales;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SignosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SignosVitales::select(
            "paciente_id",
            "frecuencia_cardiaca",
            "tension_arterial",
            "pulso",
            "temperatura",
            "frecuencia_respiratoria",
            "oxigenacion",
            "peso",
            "talla"
        )->get();
    }
    /**
     * Define las cabeceras del archivo.
     */
    public function headings(): array
    {
        return [
            "paciente_id",
            "frecuencia_cardiaca",
            "tension_arterial",
            "pulso",
            "temperatura",
            "frecuencia_respiratoria",
            "oxigenacion",
            "peso",
            "talla",
        ];
    }
}
