@extends('layouts.app')

@section('content')

    <div class="login-container">

        <div class="login-card">

            <h1>Inicia sesión</h1>

            @if ($errors->any())

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
                
            @endif

            <form action="{{route('psicologos.login.attempt')}}" method="POST">
                @csrf

                <label for="">Correo</label>
                <input type="text" name="correo" placeholder="Correo">

                <label for="">Contraseña</label>
                <input type="password" name="password" placeholder="Contraseña">

                <input type="submit" value="Iniciar sesión">
                <a href="{{route('psicologos.registro')}}">Registrarse</a>
            </form>
        </div>
    </div>
    
@endsection