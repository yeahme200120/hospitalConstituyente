<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tablaHospital extends Model
{
    protected $fillable = [
        "paciente",
        "id_paciente",
        'fecha',
        'hora',
        'servicio',
        'id_servicio',
        "estatus",
        "id_estatus",
        "cama",
        "id_cama"
    ];
}
