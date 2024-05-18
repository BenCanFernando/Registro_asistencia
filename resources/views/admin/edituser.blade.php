@extends('admin.app')
@section('content')
<br><br><br><br>
<div class="cont2">
</div>
<h1>Editar datos del usuario</h1>
	<div class="container elevation-5" align="center">
    <div class="form-row align-items-center">
    <div class="form-group col-md-12">
	<form action="{{ route('admin.edituser', ['id' => $user->id]) }}" method="post" enctype="multipart/from-data">
	@csrf
	<br>
	<input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">

	<br>
	<input type="text" class="form-control" name="lastname" id="lastname" value="{{$user->lastname}}">

	<br>
	<input type="text" class="form-control" name="username" id="username" value="{{$user->username}}">

	<br>
	<input type="number" class="form-control" name="ci" id="ci" value="{{$user->CI}}">

	<br>
	<input type="email" class="form-control" name="email" id="email" value="{{$user->email}}">

	<br>
	<input type="password" class="form-control" name="password" id="password" value="{{$user->password}}">

	<br>
	<select class="form-control" aria-label="Default select example" name="role" value="{{$user->role}}">
	  <option selected>Rol del usuario</option>
	  <option value="Admin">Admin</option>
	  <option value="Docente">Docente</option>
	  <option value="Estudiante">Estudiante</option>
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
    <a class="pull-right" href="{{route('admin.index')}} "><button type="button" class="btn btn-danger">Cancelar</button></a>
</div>	
	</form>
</div>
</div>
</div>
<br><br>
</div>

@endsection