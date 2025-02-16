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
        "estatus",
        "fecha"
    ];
}
