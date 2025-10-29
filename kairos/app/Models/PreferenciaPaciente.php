<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PreferenciaPaciente extends Model
{
    use HasFactory;

    protected $fillable = [

        'paciente_id',
        'horario_preferido',
        'dia_preferido',
        'forma_pago',
        'tipo_sesion'
    ];

}
