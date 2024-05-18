@extends('admin.app')

@section('title', 'Register')

@section('content')

<br><br><br><br>
<div class="cont2">
</div>
<h1>Nuevo usuario</h1>
	<div class="container elevation-5" align="center">
    <div class="form-row align-items-center">
    <div class="form-group col-md-12">

  <form class="mt-4" method="POST" action="">
    @csrf

    <input type="text" class="form-control" placeholder="Nombres"
    id="name" name="name">

    @error('name')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror
    <br>
    <input type="text" class="form-control" placeholder="Apellidos"
    id="lastname" name="lastname">

    @error('lastname')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror
    <br>

    <input type="number" class="form-control" placeholder="N° de cédula"
    id="CI" name="CI">

    @error('CI')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror
    <br>
    <input type="email" class="form-control" placeholder="Email"
    id="email" name="email">

    @error('email')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror
    <br>
    <select class="form-control" aria-label="Default select example" id="role" name="role">
	  <option selected>Rol del usuario</option>
	  <option value="Admin">Admin</option>
	  <option value="Docente">Docente</option>
	  <option value="Estudiante">Estudiante</option>
	  </select>

    @error('role')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror
    <br>
    <input type="password" class="form-control" placeholder="Contraseña"
    id="password" name="password">

    @error('password')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror
    <br>
    <input type="password" class="form-control" 
    placeholder="Confirmación de la contraseña" id="password_confirmation" 
    name="password_confirmation" placeholder="Confirmación de contraseña">
    <br>
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
    <button type="submit" class="btn btn-success">Guardar</button>
    <a class="pull-right" href="{{route('admin.index')}} "><button type="button" class="btn btn-danger">Cancelar</button></a>

  </form>

</div>

@endsection