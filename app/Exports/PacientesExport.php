<?php

namespace App\Exports;

use App\Models\Ingresos;
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
        return Ingresos::select(
            "pa.created_at",
            "pa.id",
            "pa.nombre",
            "pa.fecha_nac_dia",
            "pa.fecha_nac_mes",
            "pa.fecha_nac_año",
            "pa.edad",
            "pa.genero",
            "enfermedades.enfermedad",
            "pa.telefono",
            "pa.alergias",
            "ingresos.ingreso_dia",
            "ingresos.ingreso_mes",
            "ingresos.ingreso_año",
            "ingresos.ingreso_hora",
            "ingresos.diagnostico",
            "servicio.servicio",
            "camas.cama",
            "signos.frecuencia_cardiaca",
            "signos.pulso",
            "signos.frecuencia_respiratoria",
            "signos.tencion_arterial",
            "signos.temperatura",
            "signos.oxigenacion",
            "signos.peso",
            "signos.talla",
            "medicos.nombre",
            "tra.laboratorios",
            "tra.diagnostico_agregado",
            "tra.diagnostico_egreso"
            )
        ->join("pacientes as pa","pa.id","==","ingresos.paciente_id")
        ->join("signos_vitales as signos","signos.paciente_id","==","ingresos.paciente_id")
        ->join("tratamientos as tra","tra.paciente_id","==","ingresos.paciente_id")
        ->join("catalogo_medicos a medicos","medicos.id","==","tra.id_medico")
        ->join("catalogo_servicios a servicio","servicio.id","==","ingresos.id_servicio")
        ->join("catalogo_camas a camas","camas.id","==","ingresos.id_cama")
        ->join("catalogo_enfermedades_cronicas a enfermedades","enfermedades.id","==","pacientes.id_enfermedad_cronica")
        ->get();
        /* return Pacientes::sele1ct(
        "nombre",
        "fecha_nac_dia",
        "fecha_nac_mes",
        "fecha_nac_año",
        "edad",
        "genero",
        "id_enfermedad_cronica",
        "telefono",
        "alergias"
        )->get(); */
    }
    public function headings(): array
    {
        /* return [
            "nombre",
            "fecha_nac_dia",
            "fecha_nac_mes",
            "fecha_nac_año",
            "edad",
            "genero",
            "id_enfermedad_cronica",
            "telefono",
            "alergias",
        ]; */
        return [
            "created_at",
            "id",
            "nombre",
            "fecha_nac_dia",
            "fecha_nac_mes",
            "fecha_nac_año",
            "edad",
            "genero",
            "enfermedad",
            "telefono",
            "alergias",
            "ingreso_dia",
            "ingreso_mes",
            "ingreso_año",
            "ingreso_hora",
            "diagnostico",
            "servicio",
            "cama",
            "frecuencia_cardiaca",
            "pulso",
            "frecuencia_respiratoria",
            "tencion_arterial",
            "temperatura",
            "oxigenacion",
            "peso",
            "talla",
            "nombre",
            "laboratorios",
            "diagnostico_agregado",
            "diagnostico_egreso"
        ];
    }
}
