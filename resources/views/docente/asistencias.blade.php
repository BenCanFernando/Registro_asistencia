@extends('docente.app')
@section('content')
<div class="cont2">
</div>
<div class="container elevation-5">
<div class="container1">
<link rel="stylesheet" type="text/css" href="{{asset('css/Stylecss.css')}}">
<div class="elevation-4">
  </div>
 
  <div class="text-center">
	<h3>Lista de asistencias - {{ $asignatura->materia }}</h3>
</div>
<div class="container">
<a class="inline my-2 mx-lg-2 my-lg-3 float-left" href="#asist"><button type="button" class="btn btn-success">Añadir asistencia</button></a>
<form action="{{ route('docente.asistencias', ['materia' => $asignatura->code]) }}" method="GET" class="form-inline my-2 my-lg-0 float-right">
        @csrf
        <label for="fecha">Selecciona una fecha </label>
        <select name="fecha" id="fecha" class="form-control">
            @foreach ($fechasAsistencia as $fecha)
                <option value="{{ $fecha }}" {{ request('fecha') == $fecha ? 'selected' : '' }}>{{ $fecha }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-custom">Mostrar asistencias</button>
    </form>
    <br>
    <div class="table-responsive">
        <table class="table table-hover" id="tabla">
            <thead>
                <tr class="table-secondary">
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha del registro</th>
                    <th>Asistencia</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($usuarios as $usuario)
                    @if($usuario->role == 'Estudiante')
                        <tr>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->lastname }}</td>
                            @if (isset($fechaClase[$usuario->id]) && $fechaClase[$usuario->id] != ' ')
                                <td>{{ $fechaClase[$usuario->id] }}</td>
                                <td>
                                    <span class="badge {{ $usuariosAsistencia[$usuario->id] == 'Presente' ? 'badge-success' : 'badge-danger' }}">
                                        {{ $usuariosAsistencia[$usuario->id] }}
                                    </span>
                                </td>
                            @else
                                <td></td>
                                <td>
                                    <span class="badge {{ $usuariosAsistencia[$usuario->id] == 'Presente' ? 'badge-success' : 'badge-danger' }}">
                                        {{ $usuariosAsistencia[$usuario->id] }}
                                    </span>
                                </td>
                            @endif
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
<div id="asist" class="modal1">
        <div class="modal1-contenido">
            <a href="#" align="right">Volver</a>
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="container">
    <div class="jumbotron">
        <div class="form-row align-items-center">
            <div class="form-group col-md-12">
                <h1>Añadir Asistencia</h1>
                <form action="{{ route('usuarios.storeSeleccion') }}" method="post" enctype="multipart/from-data">
                    @csrf
                    <label for="materia">Materia</label>
                    <input type="text" class="form-control" name="code" id="materia" value="{{ $asignatura->code }}">
                    <br>
                    <label for="users">Selecciona usuarios</label>
					<br>
                        <select class="js-example-basic-multiple" name="usuarios_idusuario[]" multiple="multiple">
                            @foreach($usuarios as $users)
                                <option value="{{ $users->id }}">{{ $users->name }}  {{ $users->lastname }}</option>
                            @endforeach
                        </select>
						<div>
						<br>
						</div>
                    <input type="submit" class="btn btn-success" value="Guardar">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
			placeholder: 'Seleccione',
			closeOnSelect: false,
			allowClear: true,
			tags: true,
		});
    });
</script>

<br><br><br>
        </div>
    </div>
</div>
@endsection