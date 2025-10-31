@extends('layouts.app')

@section('content')
    

    <div style="border: solid 1px">

        <h1>Terapia psicológica</h1>

        <div style="border: solid 1px">


            <div style="border: solid 1px">
                
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

            <div style="border: solid 1px">

                <img src="#" alt="Imagen de la psicóloga">

            </div>

            <a href="#registro">
                <button>Agendar Cita</button>
            </a>
        </div>

    </div>

<section id="registro">

    <div style="border: solid 1px">

    <h1>Registra tus datos</h1>


        <div style="border: solid 1px">

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

</section>
@endsection