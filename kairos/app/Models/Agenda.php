<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [

        'psicolgo_id',
        'dia_semana',
        'horario_inicio',
        'horario_fin'
    ];

}
