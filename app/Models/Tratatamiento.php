<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tratatamiento extends Model
{
    protected $fillable = [
        "paciente_id",
        'id_medico',
        'diagnostico_agregado',
        'diagnostico_egreso',
        'laboratorios'
    ];
}
