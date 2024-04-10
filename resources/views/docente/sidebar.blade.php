<link rel="stylesheet" type="text/css" href="{{asset('css/Stylecss.css')}}">
<aside class="main-sidebar sidebar-dark-danger">
<a href="{{ url('/docente') }}" class="brand">
<img src="{{asset('img/logoblanco.png')}}"
             class="brand-image">
    </a>

    <div class="sidebar navbar-dark elevation-4">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('docente.menu')
            </ul>
        </nav>
    </div>
</aside>
