<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Psicologo extends Authenticatable
{
    use HasFactory;

    protected $fillable = [

        'nombre',
        'correo',
        'password',
        'tipo',
        'estado'
    ];

    protected $hidden = [

        'password',
        'remember_token'
    ];
}
