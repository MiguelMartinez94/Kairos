@extends('layouts.app')

@section('content')
    

    <div class="hero-section">

    <div class="hero-content">

        <h1>Terapia psicológica</h1>

        <div class="psicologia-info">

            <div class="info-text">

                <h2>Psic. Joanna Danaé López Ochoa</h2>

                <h3>Formación académica</h3>
                <p>Licenciatura en Psicología por la Universidad Marista de Querétaro</p>

                <p>Parrafo de bienvenida declaración de la misión (por qué y quién)</p>
            
                <p>Enfoque de la terapia, la razón por la que elegiste ser psicóloga</p>

                <h3>Especialidades</h3>

                <h3>Poblaciones con las que trabaja</h3>

                <h3>Modalidad de trabajo</h3>

                <h3>¿Cómo será la primera sesión?</h3>
            </div>

            <div class="info-imagen">

                <img src="#" alt="Imagen de la psicóloga">

            </div>

        </div>

        <a href="#registro" class="cta-button">Agendar Cita</a>

    </div>

</div>

<section id="registro" class="registro-section">
    <div class="registro-wrapper">
        <div class="registro-content">
            <h1>Registra tus datos</h1>

            @if ($errors->any())

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
                
            @endif

            
            <div class="form-container">

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
        </div>
        </div>
    </div>
</section>
@endsection