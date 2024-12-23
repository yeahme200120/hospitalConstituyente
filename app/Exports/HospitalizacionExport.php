<?php

namespace App\Exports;

use App\Models\Hospitalizacion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HospitalizacionExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Hospitalizacion::select( 
        "paciente_id",
        "medicamento",
        "dosis_max",
        "dosis_administrada",
        "id_via_administracion",
        "intervalo",
        "servicio",
        "horario",
        "diaInicio",
        "mesInicio",
        "anioInicio",
        "diaTermino",
        "mesTermino",
        "anioTermino",
        "intervencion",
        "interacciones",
        "contraindicaciones",
        "recomendacion",
        "otros",
        "accion_tomada")->get();
    }
    /**
     * Define las cabeceras del archivo.
     */
    public function headings(): array
    {
        return [
            "paciente_id",
            "medicamento",
            "dosis_max",
            "dosis_administrada",
            "id_via_administracion",
            "intervalo",
            "servicio",
            "horario",
            "diaInicio",
            "mesInicio",
            "anioInicio",
            "diaTermino",
            "mesTermino",
            "anioTermino",
            "intervencion",
            "interacciones",
            "contraindicaciones",
            "recomendacion",
            "otros",
            "accion_tomada",
        ];
    }
    /**
     * Mapea los datos para incluirlos en el archivo.
     */
    public function map($hospital): array
    {
        return [
            $hospital->paciente_id,
            $hospital->medicamento,
            $hospital->dosis_max,
            $hospital->dosis_administrada,
            $hospital->id_via_administracion,
            $hospital->intervalo,
            $hospital->servicio,
            $hospital->horario,
            $hospital->diaInicio,
            $hospital->mesInicio,
            $hospital->anioInicio,
            $hospital->diaTermino,
            $hospital->mesTermino,
            $hospital->anioTermino,
            $hospital->intervencion,
            $hospital->interacciones,
            $hospital->contraindicaciones,
            $hospital->recomendacion,
            $hospital->otros,
            $hospital->accion_tomada,
        ];
    }
}
