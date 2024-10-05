<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Unidad de Dolor</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <!-- Enlaces de navegación -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pacientes.index') }}">Ver Pacientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pacientes.create') }}">Agregar Paciente</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pacientes.trashed') }}">Pacientes Eliminados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('guia.video') }}">Guía en Vídeo</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
