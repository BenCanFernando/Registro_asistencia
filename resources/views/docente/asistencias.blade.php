@extends('docente.app')
@section('content')
<div class="cont2">
</div>
<div class="container elevation-5">
<div class="container1">
<link rel="stylesheet" type="text/css" href="{{asset('css/Stylecss.css')}}">
<div class="elevation-4">
  </div>
  <form action="{{ route('docente.asistencias', ['id' => $materia->id]) }}" method="post" enctype="multipart/from-data">
  <div class="text-center">
	<h3>Lista de asistencias - {{ $materia->materia }}</h3>
</div>
<div class="container">
    <br>
    <a class="inline my-2 mx-lg-2 my-lg-3 float-left" href="#miModal1"><button type="button" class="btn btn-success">Añadir asistencia</button></a>
    <br>
    <div class="table-responsive">
<table class="table table-hover" id="tabla">
    <thead>
        <tr class="table-secondary">
            <th>Nombre</th>
            <th>Apellido</th>
			<th>Fecha</th>
			<th>Asistencia</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($resultados as $resultado)
            <tr>
                <td>{{ $resultado['nombre_usuario'] }}</td>
                <td>{{ $resultado['apellido_usuario'] }}</td>
				<td>{{ $resultado['fecha_asistencia'] }}</td>
                <td>{{ $resultado['estado'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div id="miModal1" class="modal1">
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
                    <input type="text" class="form-control" name="materia" id="materia">
                    
                    <label for="users">Selecciona usuarios</label>
					<br>
                        <select class="js-example-basic-multiple" name="usuarios_idusuario[]" multiple="multiple">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}  {{ $user->lastname }}</option>
                            @endforeach
                        </select>
						<div>
						<br>
						</div>
                    <input type="submit" class="btn btn-success" value="Guardar">
                    <a class="pull-right" href="{{ route('docente.index') }}"><button type="button" class="btn btn-danger">Cancelar</button></a>
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

        </div>
    </div>
    
</div>
@endsection