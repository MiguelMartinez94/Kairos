@extends('layouts.app')

@section('content')

<div class="preferencias-container">
    <div class="preferencias-card">
        <h1>Paciente: {{$paciente->nombre}}</h1>

        
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


<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        const disponibilidad = @json($disponibilidad);
        
        const selectDia = document.getElementById('dia_preferido');
        const selectHora = document.getElementById('horario_preferido');

        
        Object.keys(disponibilidad).forEach(dia => {
            let option = document.createElement('option');
            option.value = dia;
            option.textContent = dia;
            selectDia.appendChild(option);
        });

        
        selectDia.addEventListener('change', function() {
            const diaSeleccionado = this.value;

            
            selectHora.innerHTML = '<option value="">Selecciona una hora</option>';
            
            if (diaSeleccionado && disponibilidad[diaSeleccionado]) {
                
                selectHora.disabled = false;

                
                disponibilidad[diaSeleccionado].forEach(hora => {
                    let option = document.createElement('option');
                    
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