@extends('layouts.app')

@section('content')
    

    <div class="hero-section">

    <div class="hero-content">

        <h1>Terapia psicológica</h1>

        <div class="psicologia-info">

            <div class="info-text">

                <h2>Psic. Joanna Danaé López Ochoa</h2>

                <h3>Formación académica</h3>
                <p>Licenciatura en Psicología por la Universidad Marista de Querétaro. Diplomado en Intervención en Crisis y Terapia Cognitivo-Conductual.</p>

                <p>Mi misión es proporcionar un espacio seguro, confidencial y libre de juicios donde podamos trabajar juntos para superar los desafíos emocionales. Creo firmemente en el potencial humano para el cambio y el crecimiento. Acompaño a mis pacientes en el proceso de autodescubrimiento, brindando herramientas prácticas basadas en evidencia para mejorar su calidad de vida y bienestar emocional.</p>
            
                <p>Elegí la psicología por una profunda vocación de servicio y fascinación por la resiliencia humana. Mi enfoque terapéutico es integral y humanista, centrado en la persona. Esto me permite adaptar el tratamiento a las necesidades únicas de cada individuo, no solo tratando los síntomas, sino buscando la raíz de los conflictos para generar cambios profundos y duraderos.</p>

                <h3>Especialidades</h3>
                <ul>
                    <li>Manejo de la ansiedad y el estrés.</li>
                    <li>Tratamiento de la depresión y regulación emocional.</li>
                    <li>Fortalecimiento de la autoestima y autoconcepto.</li>
                    <li>Procesos de duelo y pérdidas significativas.</li>
                    <li>Resolución de conflictos y desarrollo de habilidades sociales.</li>
                </ul>

                <h3>Poblaciones con las que trabaja</h3>
                <p>Me especializo principalmente en la atención clínica de <strong>adolescentes y adultos</strong>, acompañándolos en las transiciones vitales y crisis propias de estas etapas de desarrollo.</p>

                <h3>Modalidad de trabajo</h3>
                <p>Ofrezco terapia en modalidad <strong>presencial</strong> (en consultorio privado con todas las medidas de seguridad) y <strong>en línea</strong> (vía videollamada segura), brindando flexibilidad para adaptarme a tus tiempos y necesidades.</p>

                <h3>¿Cómo será la primera sesión?</h3>
                <p>La primera sesión es una entrevista inicial diagnóstica. Es un espacio tranquilo donde hablaremos sobre los motivos que te traen a terapia, tus expectativas y objetivos. No necesitas preparar nada especial; mi trabajo es guiarte a través de preguntas para entender tu contexto y explicarte cómo trabajaremos juntos para alcanzar tu bienestar.</p>
            </div>

            <div class="info-imagen">

                <img src="{{ asset('img/psicologa.png')}}" alt="Imagen de la psicóloga">

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