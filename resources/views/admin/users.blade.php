@extends('admin.app')

@section('title', 'Register')

@section('content')

<div class="text-center">
	@include('flash::message')
	<h1>Lista de Alumnos</h1>
</div>
<div class="container">
	<a class="inline my-2 my-lg-3 float-left" href="{{route('alumnos.create')}}"><button type="button" class="btn btn-success">Nuevo</button></a>
		<form class="form-inline my-2 my-lg-0 float-right">
              <input name="buscarpor" class="form-control mr-sm-2" type="search" placeholder="Buscar por nombre" aria-label="Search">
              <button class="btn btn-primary" type="submit">Buscar</button>
              </form>
              <br>
<div class="table-responsive">
	<table class="table table-hover" id="tabla">
		<thead>
			<tr class="table-secondary">
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Edad</th>
				<th>ci</th>
				<th>Telefono</th>
				<th>Direccion</th>
				<th>Gmail</th>
				<th>Profesion</th>
				<th>Genero</th>
				<th>Fecha de nacimineto</th>
				<th>Curso</th>
				<th></th>				
			</tr>
		</thead>
		<tbody>
			@foreach ($alumnos as $a)
			<tr>
				<td>{{$a->nombre}}</td>
				<td>{{$a->apellido}}</td>
				<td>{{$a->edad}}</td>
				<td>{{$a->ci}}</td>
				<td>{{$a->telefono}}</td>
				<td>{{$a->direccion}}</td>
				<td>{{$a->gmail}}</td>
				<td>{{$a->profesion}}</td>
				<td>{{$a->genero}}</td>
				<td>{{$a->fechanac}}</td>
				<td>{{$a->cursos}}</td>
			    <td>
			 	<div class="btn-group">
				 <a href="{{route('alumnos.show', $a->id )}}"><input type="submit" class="btn btn-info" value="Ver"> </a>
			 	<a href="{{url('/alumnos/'.$a->id.'/edit')}}">
			 	<input type="submit"  class="btn btn-warning mr-1 ml-1" value="Editar">
			 	</a>
                <form method="POST" action="{{ url("alumnos/{$a->id}") }}">
			      @csrf
			      @method('DELETE')
			      <input type="submit" class="btn btn-danger" onclick="return confirm('Estas seguro?')" value="Borrar">
			    </form>
                </div>
                </td>
            </tr>
			@endforeach
		</tbody>
	</table>
	<div class="d-flex justify-content-end">
    {{ $alumnos->links() }}
    <div class="pull-right mr-3">
   </div> 
  </tbody>
 </div>
</div>

@endsection