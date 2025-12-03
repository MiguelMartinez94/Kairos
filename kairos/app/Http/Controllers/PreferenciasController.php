<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Agenda;
use App\Models\PreferenciaPaciente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PreferenciasController extends Controller
{
    /**
     * Muestra el formulario con los horarios dinámicos.
     */
    public function create($pacienteId)
    {
        $paciente = Paciente::findOrFail($pacienteId);
        
        // 1. Identificamos al psicólogo actual
        $psicologoId = auth('psicologos')->id(); 

        // 2. Traemos solo los días ACTIVOS de su agenda
        $agendas = Agenda::where('psicologo_id', $psicologoId)
                            ->where('estado', 1) 
                            ->get();

        // 3. Array para guardar la estructura: { "Lunes": ["12:00", "13:00"] }
        $disponibilidad = [];

        foreach ($agendas as $agenda) {
            
            // Convertimos los horarios de la agenda a objetos Carbon
            $inicio = Carbon::parse($agenda->horario_inicio);
            $fin    = Carbon::parse($agenda->horario_fin);
            $horas  = [];

            // BUCLE: Mientras la hora actual + 1 hora no se pase de la hora de salida
            while ($inicio->copy()->addHour()->lte($fin)) {
                
                // Formatos para la vista (corto) y para la BD (largo)
                $horaVista = $inicio->format('H:i');    // "14:00"
                $horaBD    = $inicio->format('H:i:s');  // "14:00:00" (Exacto como tu BD)

                // --- VALIDACIÓN DE DISPONIBILIDAD ---
                // Verificamos si este hueco ya está "tomado" por otro paciente
                $ocupado = PreferenciaPaciente::query()
                    ->where('dia_preferido', $agenda->dia_semana)
                    ->where('horario_preferido', $horaBD) // Compara "14:00:00" con "14:00:00"
                    
                    // FILTRO DE SEGURIDAD:
                    // Aseguramos que solo revisamos pacientes de ESTE psicólogo.
                    // (Asumiendo que tu modelo Paciente tiene la columna 'psicologo_id')
                    //->whereHas('paciente', function($query) use ($psicologoId) {
                    //    $query->where('psicologo_id', $psicologoId);
                    //})
                    ->exists();

                // Si NO está ocupado, agregamos la hora a la lista para el select
                if (!$ocupado) {
                    $horas[] = $horaVista; 
                }
                
                // Avanzamos 1 hora el reloj
                $inicio->addHour();
            }

            // Solo agregamos el día al array si tiene al menos una hora libre
            if (count($horas) > 0) {
                $disponibilidad[$agenda->dia_semana] = $horas;
            }
        }

        return view('formulario_inicial.preferencias', compact('paciente', 'disponibilidad'));
    }

    /**
     * Guarda las preferencias.
     */
    public function store(Request $request, $pacienteId)
    {
        // 1. Validamos que los datos vengan y sean correctos
        $validated = $request->validate([
            'dia_preferido'     => 'required|string',
            'horario_preferido' => 'required', // Laravel aceptará "14:00" y MySQL lo convertirá a "14:00:00"
            'forma_pago'        => 'required|string',
            'tipo_sesion'       => 'required|string',
        ]);

        // 2. Guardamos (Eloquent maneja la conversión de hora automáticamente)
        PreferenciaPaciente::create([
            'paciente_id'       => $pacienteId,
            'dia_preferido'     => $validated['dia_preferido'],
            'horario_preferido' => $validated['horario_preferido'],
            'forma_pago'        => $validated['forma_pago'],
            'tipo_sesion'       => $validated['tipo_sesion'],
        ]);

        // 3. Redirección
        return view('formulario_inicial.mensaje');
    }
}