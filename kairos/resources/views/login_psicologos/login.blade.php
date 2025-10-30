@extends('layouts.app')

@section('content')

    <div style="border: solid 1px">

        <div style="border: solid 1px">

            <h1>Inicia sesión</h1>

            <form action="#">
                @csrf

                <label for="">Correo</label>
                <input type="text" name="correo" placeholder="Correo">

                <label for="">Contraseña</label>
                <input type="password" name="contrasena" placeholder="Contraseña">

                <input type="submit" value="Iniciar sesión">
                <a href="{{route('psicologos.registro')}}">Registrarse</a>
            </form>
        </div>
    </div>
    
@endsection