<li class="nav-item">
<a href="{{ url('/estudiante') }}" class="brand-link">
        <img src="{{asset('img/Inicio.png')}}"
             class="brand-image">
        <span>Inicio</span>
        </a>
</li>


<li class="nav-item">
<a href="{{ route('estudiante.asignatura') }}" class="brand-link">
<img src="{{asset('img/Materias.png')}}"
             class="brand-image">
        <span>Materias</span>
        </a>
</li>


<li class="nav-item">
<a href="{{ route('estudiante.index') }}" class="brand-link">
<img src="{{asset('img/escaner.png')}}"
             class="brand-image">
        <span>Escanear</span>
    </a>
</li>
