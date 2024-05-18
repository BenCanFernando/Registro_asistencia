<link rel="stylesheet" type="text/css" href="{{asset('css/Stylecss.css')}}">
<li class="nav-item">
<a href="{{ url('/admin') }}" class="brand-link">
        <img src="{{asset('img/Inicio.png')}}"
             class="brand-image">
        <span>Inicio</span>
        </a>
</li>

<li class="nav-item">
<a href="{{ route('admin.createuser') }}" class="brand-link">
        <img src="{{asset('img/Usuarios.png')}}"
             class="brand-image">
        <span>Usuarios</span>
        </a>
</li>


<li class="nav-item">
<a href="{{ route('admin.createcurso') }}" class="brand-link">
        <img src="{{asset('img/Cursos.png')}}"
             class="brand-image">
        <span>Cursos</span>
    </a>
</li>


<li class="nav-item">
<a href="{{ route('admin.createmateria') }}" class="brand-link">
        <img src="{{asset('img/Materias.png')}}"
             class="brand-image">
        <span>Materias</span>
    </a>
</li>


