<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function paciente(): BelongsTo //
    {
        return $this->belongsTo(Paciente::class); //
    }

}
