@extends('layouts.app')

@section('content')

<div class="preferencias-container">
    <div class="preferencias-card">
        <h1>Paciente: {{$paciente->nombre}}</h1>

        {{-- Manejo de errores --}}
        @if ($errors->any())
            <div style="color: red; margin-bottom: 10px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form action="{{route('preferencias.store', ['paciente' => $paciente->id])}}" method="POST">
            @csrf
            <input type="hidden" name="paciente_id" value="{{$paciente->id}}">

            <div class="form-group">
                
                <label for="dia_preferido">Día preferido</label>
                <select name="dia_preferido" id="dia_preferido" required>
                    <option value="">Selecciona un día</option>
                    </select>

                <label for="horario_preferido">Horario Preferido</label>
                <select name="horario_preferido" id="horario_preferido" required disabled>
                    <option value="">Primero selecciona un día</option>
                </select>
                
                <label for="">Forma de pago</label>
                <select name="forma_pago" required>
                    <option value="" selected>Selecciona el tipo de pago</option>
                    <option value="efectivo">Efectivo</option>
                    <option value="transferecia">Transferencia</option>
                </select>

                <label for="">Tipo de sesión</label>
                <select name="tipo_sesion" required>
                    <option value="" selected>Selecciona el tipo de sesión</option>
                    <option value="en linea">En línea</option>
                    <option value="presencial">Presencial</option>
                </select>

                <br><br>
                <input type="submit" value="Agendar Cita">
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT PARA LA LÓGICA DINÁMICA --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Recibimos los datos del controlador
        const disponibilidad = @json($disponibilidad);
        
        const selectDia = document.getElementById('dia_preferido');
        const selectHora = document.getElementById('horario_preferido');

        // 2. Llenar el select de Días (solo los días que trabaja la psicóloga)
        // Object.keys obtiene ["Lunes", "Martes", etc.]
        Object.keys(disponibilidad).forEach(dia => {
            let option = document.createElement('option');
            option.value = dia;
            option.textContent = dia;
            selectDia.appendChild(option);
        });

        // 3. Evento: Cuando cambia el día, actualizamos las horas
        selectDia.addEventListener('change', function() {
            const diaSeleccionado = this.value;

            // Limpiar horas anteriores
            selectHora.innerHTML = '<option value="">Selecciona una hora</option>';
            
            if (diaSeleccionado && disponibilidad[diaSeleccionado]) {
                // Habilitar el select
                selectHora.disabled = false;

                // Llenar con las horas disponibles de ese día
                disponibilidad[diaSeleccionado].forEach(hora => {
                    let option = document.createElement('option');
                    // Enviamos formato TIME (HH:MM)
                    option.value = hora; 
                    option.textContent = hora;
                    selectHora.appendChild(option);
                });
            } else {
                selectHora.disabled = true;
                selectHora.innerHTML = '<option value="">Primero selecciona un día</option>';
            }
        });
    });
</script>

@endsection