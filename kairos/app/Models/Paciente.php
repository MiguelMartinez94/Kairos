<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Paciente extends Model
{
    use HasFactory;
    
    protected $fillable = [

        'nombre',
        'edad',
        'genero',
        'telefono',
        'correo',
        'estado'

    ];

    public function preferencia()
    {
        return $this->hasOne(PreferenciaPaciente::class, 'paciente_id');
    }
}
