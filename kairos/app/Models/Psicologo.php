<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Psicologo extends Model
{
    use HasFactory;

    protected $fillable = [

        'nombre',
        'correo',
        'contrasena',
        'tipo',
        'estado'
    ];
}
