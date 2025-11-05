@extends('layouts.app')

@section('content')

    <div class="registro-container">

        <div class="registro-card">

            <h1>Registrarse</h1>

            @if ($errors->any())

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
                
            @endif

            <form action="{{route('psicologos.store')}}" method="POST">
                @csrf

                <label for="">Nombre completo</label>
                <input type="text" name="nombre" placeholder="Nombre">

                <label for="">Correo</label>
                <input type="text" name="correo" placeholder="Correo">

                <label for="">Contraseña</label>
                <input type="password" name="password" placeholder="Contraseña">

                
                <input type="submit" value="Registrarse">
                <form action="{{route('psicologos.login')}}" method="GET">
                    @csrf

                    <input type="submit" value="Volver">
                </form>
            </form>
        </div>
    </div>
    
@endsection