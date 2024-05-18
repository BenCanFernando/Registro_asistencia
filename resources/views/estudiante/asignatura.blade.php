@extends('estudiante.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/Stylecss.css')}}">
<div class="cont2">
</div>
<div class="container elevation-5">
<div class="container1">
<div class="text-center">
	<h3>Lista de materias</h3>
</div>
			@foreach ($registros as $registro)

			<div class="mole" style="display: flex;">
      <div class="cards">
<div class="card card--1">
<div class="card__img">&nbsp;</div>
<div class="card__img--hover" align="center">{{$registro->materia}}<em style="display:none">&nbsp;</em></a></div>
<div class="facultades">
@if($registro->cursos->facultad == 'FACAT')
<img src="img/facat.jpg" class="card-image">
@elseif($registro->cursos->facultad == 'FACEM')
<img src="img/facem.jpg" class="card-image">
@elseif($registro->cursos->facultad == 'FCJHS')
<img src="img/fcjhs.jpg" class="card-image">
@elseif($registro->cursos->facultad == 'FACQUF')
<img src="img/facquf.jpg" class="card-image">
@elseif($registro->cursos->facultad == 'FACVA')
<img src="img/facva.jpg" class="card-image">
@elseif($registro->cursos->facultad == 'ISEDE')
<img src="img/isede.jpg" class="card-image">
@endif
</div>
<div class="card__img--hover2" align="center">{{$registro->cursos->curso ?? 'N/A'}} {{$registro->cursos->carrera ?? 'N/A'}}<em style="display:none height:20px">&nbsp;</em></a></div>

<div class="button">
    <a href="{{ route('estudiante.detalles', ['code' => $registro->code]) }}">
        <input type="submit" class="bttn mr-1 ml-1" value="Ver detalles">
    </a>
</div>
  </div>
</div>
</div>
			@endforeach
@endsection