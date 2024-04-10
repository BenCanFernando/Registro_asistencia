@extends('admin.app')

@section('title', 'Register')

@section('content')

<link rel="stylesheet" href="css/Stylecss2.css">
<div class="container">

	<div class="jumbotron">
   <div class="form-row align-items-center">
    <div class="form-group col-md-12">
	<h1>Editar Materia</h1>
	<form action="{{ route('admin.editmateria', ['id' => $asig->id]) }}" method="post" enctype="multipart/from-data">
	<form action="{{ route('admin.editmateria', ['id' => $curs->id]) }}" method="post" enctype="multipart/from-data">
	@csrf
	<label for="materia">Materia</label>
	<input type="text" class="form-control" name="materia" id="materia" value="{{$asig->materia}}">

	<label for="curso">Curso</label>
	<input type="text" class="form-control" name="curso" id="curso" value="{{$curs->curso}}">

	<label for="carrera">Carrera</label>
	<input type="text" class="form-control" name="carrera" id="carrera" value="{{$curs->carrera}}">

	<label for="facultad">Facultad</label>
	<input type="text" class="form-control" name="facultad" id="facultad" value="{{$curs->facultad}}">
	<div>
		<br>
    <input type="submit" class="btn btn-success" value="Guardar">
    <a class="pull-right" href="{{route('admin.index')}} "><button type="button" class="btn btn-danger">Cancelar</button></a>
	</div>	
	</form>
</div>
</div>
</div>
</div>

@endsection