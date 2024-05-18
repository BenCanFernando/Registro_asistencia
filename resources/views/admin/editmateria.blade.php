@extends('admin.app')
@section('content')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<br><br>
<div class="cont2">
</div>
<h3 class="text-5xl text-center">Editar materia</h3>
	<div class="container elevation-5" align="center">
    <div class="form-row align-items-center">
    <div class="form-group col-md-12">
 
	<form action="{{ route('admin.editmateria',  ['id' => $materia->id]) }}" method="post" enctype="multipart/from-data">
                    @csrf
                    <label for="materia">Materia</label>
                    <input type="text" class="form-control" name="materia" id="materia" value="{{ $materia ->materia }}" required>
                    <br><br>
                    <label for="users">Seleccionar curso</label>
					<br>
                        <select class="js-example-basic-multiple js-states form-control" name="cursos_idcurso[]" multiple="multiple">
                        @foreach($cursos as $cursoId => $curso)
            <option value="{{ $cursoId }}" {{ in_array($cursoId, $materia->cursos->pluck('id')->toArray()) ? 'selected' : '' }}>
                {{ $curso->curso }}{{ $curso->carrera }}
            </option>
        @endforeach
                        </select>
                        <br><br>

                    <label for="users">Seleccionar usuarios</label>
					<br>
                        <select class="js-example-basic-multiple js-states form-control" name="usuarios_idusuario[]" multiple="multiple">
                        @foreach($usuarios as $usuarioId => $usuario)
                        <option value="{{ $usuarioId }}" {{ in_array($usuarioId, $materia->cursos->pluck('id')->toArray()) ? 'selected' : '' }}>
                {{ $usuario->name }} {{ $usuario->lastname }}
            </option>
    @endforeach
                        </select>
						<div>
                        @if (count($errors)>0)
                        <div class="alert alert-danger" role="aler">
	<u>
		@foreach ($errors->all() as $error)
		<li>
			{{$error}}
		</li>
		@endforeach
	</u>
@endif
</div>
						<br>
						
                    <input type="submit" class="btn btn-success" value="Guardar">
                    <a class="pull-right" href="{{ route('admin.index') }}"><button type="button" class="btn btn-danger">Cancelar</button></a>
                </form>
            </div>
        </div>
    </div>
    <br><br><br><br><br>
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

@endsection