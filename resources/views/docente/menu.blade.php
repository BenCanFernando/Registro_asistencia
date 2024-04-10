<li class="nav-item">

<a href="{{ url('/docente') }}" class="brand-link">
        <img src="{{asset('img/Inicio.png')}}"
             alt="Inicio"
             class="brand-image">
        <span>Inicio</span>
        </a>
</li>

<a href="{{ route('docente.index') }}" class="brand-link">
<img src="{{asset('img/Materias.png')}}"
             alt="Materias"
             class="brand-image">
        <span>Materias</span>
        </a>
</li>


<li class="nav-item">
<a href="{{ route('docente.cursos') }}" class="brand-link">
<img src="{{asset('img/Asistencia.png')}}"
             alt="Asistencias"
             class="brand-image">
        <span>Asistencias</span>
    </a>
</li>