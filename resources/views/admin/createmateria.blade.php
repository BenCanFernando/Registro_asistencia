@extends('admin.app')
@section('content')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<br><br><br><br>
<div class="cont2">
</div>
<h3 class="text-5xl text-center">Nueva materia</h3>
	<div class="container elevation-5" align="center">
    <div class="form-row align-items-center">
    <div class="form-group col-md-12">
                <form action="{{ route('usuarios.storeSeleccion') }}" method="post" enctype="multipart/from-data">
                    @csrf
                    <label for="materia">Materia</label>
                    <input type="text" class="form-control" name="materia" id="materia" placeholder="Nombre de la materia">

                    <label for="materia">Seleccionar curso</label>
                    <div class="form-group col-md-13">
                        {!! Form::label('') !!}
                        {!! Form::select('cursos_idcurso', $cursos, null, ['class' => 'form-control custom-select','placeholder'=>'Seleccione']) !!}
                    </div>

                    <label for="users">Selecciona usuarios</label>
					<br>
                        <select class="js-example-basic-multiple" name="usuarios_idusuario[]" multiple="multiple">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}  {{ $user->lastname }}</option>
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
						</div>
                    <input type="submit" class="btn btn-success" value="Guardar">
                    <a class="pull-right" href="{{ route('admin.index') }}"><button type="button" class="btn btn-danger">Cancelar</button></a>
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

@endsection
