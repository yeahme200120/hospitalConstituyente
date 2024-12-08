<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignosVitales extends Model
{
    protected $fillable = [
        "paciente_id",
        'frecuencia_cardiaca',
        'tension_arterial',
        'pulso',
        'temperatura',
        'frecuencia_respiratoria',
        'oxigenacion',
        'peso',
        'talla',
    ];
}
