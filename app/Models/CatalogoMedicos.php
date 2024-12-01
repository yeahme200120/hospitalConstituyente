<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogoMedicos extends Model
{
    protected $fillable = [
        'nombre',
        'cedula',
        'especialidad',
    ];
}
