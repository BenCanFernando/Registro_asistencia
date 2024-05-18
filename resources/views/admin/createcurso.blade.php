@extends('admin.app')
@section('content')

<br><br>
<div class="cont2">
</div>
<h3 class="text-5xl text-center">Nuevo curso</h3>
	<div class="container elevation-5" align="center">
    <div class="form-row align-items-center">
    <div class="form-group col-md-12">
	<form action="{{url('/cursoadd')}}" method="post" enctype="multipart/from-data">
	@csrf
	<br>
	<label for="curso">Curso (año-semestre)</label>
	<input type="text" class="form-control" name="curso" id="curso" placeholder="Ej.: 1°2°">
	<br>
	<label for="carrera">Carrera</label>
	<input type="text" class="form-control" name="carrera" id="carrera" placeholder="Ej.: Diseño Gráfico">
	<br>
	<label for="facultad">Facultad</label>
	<select class="form-control" aria-label="Default select example" name="facultad" >
	  <option selected>Selecione</option>
	  <option value="FACAT">FACAT</option>
	  <option value="FACEM">FACEM</option>
	  <option value="FCJHS">FCJHS</option>
	  <option value="FACQUF">FACQUF</option>
	  <option value="FACVA">FACVA</option>
	  <option value="ISEDE">ISEDE</option>
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
    <input type="submit" class="btn btn-success" align="center" value="Guardar">
    <a class="pull-right" href="{{route('admin.index')}} "><button type="button" class="btn btn-danger">Cancelar</button></a>
		
	</form>
</div>
</div>
<br><br><br><br>
</div>
</div>
<br><br><br>

@endsection