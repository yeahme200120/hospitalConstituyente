<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    protected $fillable = [
        'nombre',
        'id_paciente',
        'fecha_nac_dia',
        'fecha_nac_mes',
        'fecha_nac_año',
        'edad',
        'genero',
        'id_enfermedad_cronica',
        'telefono',
        'alergias'
    ];
}
