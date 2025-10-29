<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clinico extends Model
{
    use HasFactory;

    protected $fillable = [

        'paciente_id',
        'fecha_inicio',
        'diagnostico',
        'tratamiento',
        'observaciones'
    ];
}
