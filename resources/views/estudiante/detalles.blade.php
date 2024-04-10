@extends('estudiante.app')
@section('title', 'Register')
@section('content')
<link rel="stylesheet" href="css/Stylecss.css">
<div class="elevation-4">
  </div>
  <form action="{{ route('docente.asistencias', ['id' => $materia->id]) }}" method="post" enctype="multipart/from-data">
  <div class="text-center">
	<h1>{{ $materia->materia }}</h1>
</div>
<div class="container elvation-3">
 <h4 class="text-5xl text-center">Porcentaje de Asistencias</h4>
<div class="porcentaje elevation-5">
  
  <h2 class="text-5xl text-center">{{ $porcentaje }}%</h2></div>

  </div>
  <h4 class="text-5xl text-center">Clases dadas: {{ $clases }}      Clases asistidas: {{ $asiste }}     Clases perdidas: {{ $clasesP }}</h4>
    
</div>
@endsection