@extends('admin.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/Stylecss.css')}}">
<div class="contaner1">
<br>
<div class="flash-container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>
<div class="container elevation-5">
    <h3 class="text-5xl text-center">Panel de usuarios</h3>
    <div class="btn0"><a class="inline my-2 my-lg-3 float-left" href="createuser"><button type="button" class="btn btn-success">+ Añadir usuario</button></a></div>
    <div class="btn1"><a class="inline my-2 mx-lg-2 my-lg-3 float-left" href="#miModal1"><button type="button" class="btn btn-success">! Registro de cambios</button></a></div>

    <form class="form-inline my-2 my-lg-0 float-right">
        <input name="buscar" class="form-control mr-sm-2" type="search" placeholder="Buscar por C.I." aria-label="Search">
        <div class="btn2"><button class="btn btn-custom" type="submit">Buscar</button></div>
    </form>
    <br>
    <div id="miModal1" class="modal1">
        <div class="modal1-contenido">
            <a href="CORREGIR" align="right">Volver</a>
            <b><h6 align="center">Auditoría de usuarios</h6></b>
            <div style="overflow-y: scroll; height: 200px;">
                <table class="table table-hover" id="tabla">
                    <thead>
                        <tr class="table-secondary">
                            <th>Usuario</th>
                            <th>Acción</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userAudit as $a)
                        <tr>
                            <td>{{$a->user_name}}</td>
                            <td>{{$a->action}}</td>
                            <td>{{$a->action_timestamp}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <b><h6 align="center">Auditoría de asistencias</h6></b>
            <div style="overflow-y: scroll; height: 200px;">
                <table class="table table-hover" id="tabla">
                    <thead>
                        <tr class="table-secondary">
                            <th>Usuario</th>
                            <th>Acción</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asistenciaAudit as $a)
                        <tr>
                            <td>{{$a->asistencia_id}}</td>
                            <td>{{$a->action}}</td>
                            <td>{{$a->action_timestamp}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover" id="tabla">
            <thead>
                <tr class="table-secondary">
                    <th class="col">Nombre</th>
                    <th class="col text-center">Apellido</th>
                    <th class="col text-center">CI</th>
                    <th class="col text-center">Email</th>
                    <th class="col">Rol</th>
                    <th class="col text-center">Estado</th>
                    <th class="col text-center">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $a)
                <tr>
                    <td>{{$a->name}}</td>
                    <td>{{$a->lastname}}</td>
                    <td>{{$a->CI}}</td>
                    <td>{{$a->email}}</td>
                    <td>{{$a->role}}</td>
                    <td>@switch(true)
                        @case($a->state =='Activo')
                        <span class="badge badge-success">{{$a->state}}</span>
                        @break</td>
                        @case($a->state =='Inactivo')
                        <span class="badge badge-danger">{{$a->state}}</span>
                        @break</td>
                        @endswitch
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.edituser', ['id' => $a->id]) }}">
                                    <input type="submit"  class="btn btn-warning mr-1 ml-1" value="Editar">
                                </a>
                                <form action="{{ route('cambiar-estado') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $a->id }}">
                                    <input type="hidden" name="state" value="{{ $a->state }}">
                                    @if($a->state == 'Activo')
                                    <input type="submit" class="btn btn-danger" onclick="return confirm('¿Deshabilitar usuario?')" value="Deshabilitar">
                                    @else
                                    <input type="submit" class="btn btn-success" onclick="return confirm('¿Habilitar usuario?')" value="Habilitar">
                                    @endif
                                </form>
                            </div>
                        </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-5px">
        {{ $users->links() }} 
    </div>
    <div class="card-container">
        <div class="card1 elevation-3">
            <h2 class="text-5xl text-center">Total de usuarios: {{ $cantuser }}</h2>
        </div>
        <div class="card2 elevation-3">
            <h2 class="text-5xl text-center">Total de docentes: {{ $cantdoc }}</h2>
        </div>
        <div class="card3 elevation-3">
            <h2 class="text-5xl text-center">Total de estudiantes: {{ $cantest }}</h2>
        </div>
        <br>
    </div>
</div>


<div class="container elevation-5">
    <h3 class="text-5xl text-center">Panel de carreras y cursos</h3>
    <div class="btn0"><a class="inline my-2 my-lg-3 float-left" href="{{route('admin.createcurso')}}"><button type="button" class="btn btn-success">+ Agregar curso</button></a></div>
    <div class="btn1"><a class="inline my-2 mx-lg-2 my-lg-3 float-left" href="{{route('admin.createmateria')}}"><button type="button" class="btn btn-success">+ Agregar materia</button></a></div>
    <form class="form-inline my-2 my-lg-0 float-right">
        <input name="buscar" class="form-control mr-sm-2" type="search" placeholder="Buscar materias" aria-label="Search">
        <div class="btn2"><button class="btn btn-custom" type="submit">Buscar</button></div>
    </form>
    <br>
    <div class="table-responsive float-left">
        <table class="table table-hover" id="tabla">
            <thead>
                <tr class="table-secondary">
                    <th>Facultad</th>
                    <th>Carrera</th>
                    <th>Materia</th>
                    <th>Opciones</th>                
                </tr>
            </thead>
            <tbody>
                @foreach ($materias as $a)
                <tr>
                    <td>{{$a->cursos->facultad}}</td>
                    <td>{{$a->cursos->curso}}{{$a->cursos->carrera}}</td>
                    <td>{{$a->materia}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.editmateria', ['id' => $a->id]) }}">
                                <input type="submit"  class="btn btn-warning mr-1 ml-1" value="Editar">
                            </a>
                            <form method="POST" action="{{ url("index/{$a->id}") }}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')" value="Borrar">
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-5px">
            {{ $users->links() }} 
        </div>
    </div>
    <div class="card-container">
        <div class="card1 elevation-3">
            <h2 class="text-5xl text-center">Total de cursos: {{ $cantcurso }}</h2>
        </div>
        <div class="card2 elevation-3">
            <h2 class="text-5xl text-center">Total de materias: {{ $cantasig }}</h2>
        </div>
        <div class="card3 elevation-3"> 
            <h2 class="text-5xl text-center">Total de carreras: {{ $cantest }}</h2>
        </div>
    </div>
</div>
<br>
</div>
</div>
@endsection
