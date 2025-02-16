<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnosticos extends Model
{
    protected $fillable = [
        "paciente_id",
        'id_medico',
        'diagnostico_agregado',
        'diagnostico_egreso',
        'laboratorios',
        'fecha'
    ];
}
