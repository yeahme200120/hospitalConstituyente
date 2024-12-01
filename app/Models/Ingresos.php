<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingresos extends Model
{
    protected $fillable = [
        'ingreso_dia',
        'ingreso_mes',
        'ingreso_año',
        'ingreso_hora',
        "diagnostico",
        'id_servicio',
        "id_cama",
    ];
}
