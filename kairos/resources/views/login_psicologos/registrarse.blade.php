@extends('layouts.app')

@section('content')

    <div style="border: solid 1px">

        <div style="border: solid 1px">

            <h1>Registrarse</h1>

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