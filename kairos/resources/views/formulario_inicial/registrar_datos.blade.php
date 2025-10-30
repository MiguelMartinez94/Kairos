@extends('layouts.app')

@section('content')
    

    <h1>Registra tus datos</h1>

    <form action="{{route('formulario.store')}}" method="POST">

        @csrf

        <label for="">Nombre completo</label>
        <input type="text" placeholder="Ingresa tu nombre completo" name="nombre">

        <label for="">Edad</label>
        <input type="number" name="edad">

        <label for="">Género</label>
        <select name="genero" >
            <option value="" selected>Selecciona tu género</option>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
            
        </select>

        <label for="">Teléfono</label>
        <input type="text" name="telefono">

        <label for="">correo</label>
        <input type="email" name="correo">

        <input type="submit" value="Seleccionar día y horario">
    </form>


@endsection