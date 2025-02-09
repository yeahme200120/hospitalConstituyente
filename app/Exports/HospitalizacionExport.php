<?php

namespace App\Exports;

use App\Models\Hospitalizacion;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;

class HospitalizacionExport implements FromCollection,WithHeadings
{
    protected $pacienteId;
    protected $fecha;

    public function __construct($pacienteId, $fech)
    {
        $this->pacienteId = $pacienteId;
        $this->fecha = $fech;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Hospitalizacion::select( 
        "hospitalizacions.created_at as fecha",
        "p.id_paciente",
        "p.nombre",
        "hospitalizacions.medicamento",
        "hospitalizacions.dosis_max",
        "hospitalizacions.dosis_administrada",
        "hospitalizacions.id_via_administracion",
        "hospitalizacions.intervalo",
        "hospitalizacions.horario",
        "hospitalizacions.diaInicio",
        "hospitalizacions.mesInicio",
        "hospitalizacions.anioInicio",
        "hospitalizacions.diaTermino",
        "hospitalizacions.mesTermino",
        "hospitalizacions.anioTermino",
        "hospitalizacions.intervencion",
        "hospitalizacions.interacciones",
        "hospitalizacions.contraindicaciones",
        "hospitalizacions.recomendacion",
        "hospitalizacions.otros",
        "hospitalizacions.accion_tomada")
        ->join("pacientes as p","p.id","=","hospitalizacions.paciente_id")
        ->where("p.id","=", $this->pacienteId)
        ->where("hospitalizacions.created_at", "like", $this->fecha.'%')
        ->get();
    }
    /**
     * Define las cabeceras del archivo.
     */
    public function headings(): array
    {
        return [
            "Fecha",
            "paciente_id",
            "nombre",
            "medicamento",
            "dosis_max",
            "dosis_administrada",
            "id_via_administracion",
            "intervalo",
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
            $hospital->fecha,
            $hospital->paciente_id,
            $hospital->nombre,
            $hospital->medicamento,
            $hospital->dosis_max,
            $hospital->dosis_administrada,
            $hospital->id_via_administracion,
            $hospital->intervalo,
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
