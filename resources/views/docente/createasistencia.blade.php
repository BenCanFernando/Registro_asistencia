@extends('admin.app')

@section('title', 'Register')

@section('content')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="container">
    <div class="jumbotron">
        <div class="form-row align-items-center">
            <div class="form-group col-md-12">
                <h3>Añadir Asistencia</h3>
                <form action="{{ route('usuarios.storeSeleccion') }}" method="post" enctype="multipart/from-data">
                    @csrf
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
                    <a class="pull-right" href="{{ route('admin.index') }}"><button type="button" class="btn btn-danger">Cancelar</button></a>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Agregar este script para inicializar Select2 -->
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