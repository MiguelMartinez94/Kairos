<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Agenda;

class AgendasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Agenda::create([

            'psicologo_id' => '1',
            'dia_semana' => 'Lunes',
            'horario_inicio' => '08:00',
            'horario_fin' => '16:00',
            'estado' => '1'

        ]);

        Agenda::create([

            'psicologo_id' => '1',
            'dia_semana' => 'Martes',
            'horario_inicio' => '08:00',
            'horario_fin' => '16:00',
            'estado' => '1'

        ]);

        Agenda::create([

            'psicologo_id' => '1',
            'dia_semana' => 'Miercoles',
            'horario_inicio' => '08:00',
            'horario_fin' => '16:00',
            'estado' => '1'

        ]);

        Agenda::create([

            'psicologo_id' => '1',
            'dia_semana' => 'Jueves',
            'horario_inicio' => '08:00',
            'horario_fin' => '16:00',
            'estado' => '1'

        ]);

        Agenda::create([

            'psicologo_id' => '1',
            'dia_semana' => 'Viernes',
            'horario_inicio' => '08:00',
            'horario_fin' => '16:00',
            'estado' => '1'

        ]);

        Agenda::create([

            'psicologo_id' => '1',
            'dia_semana' => 'Sabado',
            'horario_inicio' => '08:00',
            'horario_fin' => '16:00',
            'estado' => '1'

        ]);

        Agenda::create([

            'psicologo_id' => '1',
            'dia_semana' => 'Domingo',
            'horario_inicio' => '08:00',
            'horario_fin' => '16:00',
            'estado' => '1'

        ]);
    }
}
