<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sesion extends Model
{
    use HasFactory;

    protected $fillable = [

        'psicologo_id',
        'paciente_id',
        'fecha_sesion',
        'duracion',
        'notas'
    ];
}
