@extends('docente.app')
@section('content')

<div class="text-center">
	<h3>Lista de materias</h3>
</div>
			@foreach ($registros as $registro)

			<div style="display:flex;justify-content:center;box-sizing:border-box">
<div class="cards">
<div class="card card--1">
<div class="card__img">&nbsp;</div>
<div class="card__img--hover" align="center"><a href="{{$registro->materia}}">{{$registro->materia}}<em style="display:none">&nbsp;</em></a></div>
<div class="button">
    <div class="centro">
      <button class="btn">
        <a href="{{ route('docente.show', $registro->id) }}" data-ycbm-modal="true" class="bttn">
        <svg width="180px" height="60px" viewBox="0 0 180 60" class="border">
          <polyline points="179,1 179,59 1,59 1,1 179,1" class="bg-line" />
          <polyline points="179,1 179,59 1,59 1,1 179,1" class="hl-line" />
         </svg>
         <span>Generar código QR </span>
        </a>
      </button>
    </div>
  </div>
</div>
</div> 
</div>
			@endforeach
@endsection