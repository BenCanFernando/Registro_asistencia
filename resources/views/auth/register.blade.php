@extends('admin.app')

@section('title', 'Register')

@section('content')


<div class="container">
<div class="jumbotron">
   <div class="form-row align-items-center">
    <div class="form-group col-md-12">


  <h1>Crear usuario</h1>

  <form class="mt-4" method="POST" action="">
    @csrf

    <label for="name">Nombre</label>
    <input type="text" class="form-control" placeholder=""
    id="name" name="name">

    @error('name')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror

    <label for="name">Apellido</label>
    <input type="text" class="form-control" placeholder=""
    id="lastname" name="lastname">

    @error('lastname')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror

    <label for="name">Usuario</label>
    <input type="text" class="form-control" placeholder=""
    id="username" name="username">

    @error('username')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror

    <label for="name">Cédula de identidad</label>
    <input type="text" class="form-control" placeholder="CI"
    id="CI" name="CI">

    @error('CI')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror

    <label for="name">Email</label>
    <input type="email" class="form-control" placeholder="Email"
    id="email" name="email">

    @error('email')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror

    <label for="name">Contraseña</label>
    <input type="password" class="form-control" placeholder="Password"
    id="password" name="password">

    @error('password')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror

    <label for="role">Rol</label>
	<select class="custom-select " aria-label="Default select example" name="role" >
	  <option selected>Selecione</option>
	  <option value="Admin">Admin</option>
	  <option value="Docente">Docente</option>
	  <option value="Estudiante">Estudiante</option>
	</select>

    @error('role')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full
      text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror

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