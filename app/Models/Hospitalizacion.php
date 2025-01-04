<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospitalizacion extends Model
{
    protected $fillable = [
        "paciente_id", 
        "medicamento", 
        "dosis_max", 
        "dosis_administrada", 
        "id_via_administracion",
        "opcion_duplicidad",
        "opcion_intervencion",
        "opcion_aceptacion",
        "opcion_sin_cambios",
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
        "estatus"
    ];
}
