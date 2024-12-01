<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospitalizacion extends Model
{
    protected $fillable = [
        "id_paciente", 
        "medicamento", 
        "dosis_max", 
        "dosis_administrada", 
        "id_via_administracion", 
        "intervalo", 
        "horario",
        "fecha_inicio",
        "fecha_termino",
        "duplicidad",
        "intervencion",
        "acepatcion",
        "interacciones",
        "contraindicaciones",
        "recomendacion",
        "intervencion_text",
        "otros",
        "accion_tomada"
    ];
}
