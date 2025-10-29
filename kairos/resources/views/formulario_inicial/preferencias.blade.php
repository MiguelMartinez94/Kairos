@extends('layouts.app')

@section('content')


<h1>Paciente: {{$paciente->nombre}}</h1>
    
    <form action="{{route('preferencias.store', ['paciente' => $paciente->id])}}" method="POST">

        @csrf

        <input type="hidden" name="paciente_id" value="{{$paciente->id}}">

        <label for="">Horario Preferido</label>
        <input type="time" name="horario_preferido">
        
        <label for="">Día preferido</label>
        <select name="dia_preferido" id="">
            <option value="lunes">Lunee</option>
            <option value="martes">Martes</option>
            <option value="miercoles">Miércoles</option>
            <option value="jueves">Jueves</option>
            <option value="viernes">Viernes</option>
            <option value="sabado">Sábado</option>
            <option value="domingo">Domingo</option>
        </select>

        <label for="">Forma de pago</label>
        <select name="forma_pago" id="">
            <option value="" selected>Selecciona el tipo de pago</option>
            <option value="efectivo">Efectivo</option>
            <option value="transferecia">Transferencia</option>
        </select>

        <label for="">Tipo de sesión</label>
        <select name="tipo_sesion" id="">
            <option value="" selected>Selecciona el tipo de sesión</option>
            <option value="en linea">En línea</option>
            <option value="presencial">Presencial</option>
        </select>

        <input type="submit" value="Agendar Cita">
    </form>

@endsection