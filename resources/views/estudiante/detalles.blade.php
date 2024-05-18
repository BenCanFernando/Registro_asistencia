@extends('estudiante.app')
@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/Stylecss.css')}}">
<div class="cont2">
</div>
<div class="container elevation-5">
<div class="container1">
<div class="text-center">
 
	<h3 class="text-center">{{ $materia }}</h3>
</div>
<div style="mr-5">
 <h4 class="text-5xl text-center">Porcentaje de Asistencias</h4>
 <div id="chart_div" style="width: 800px; height: 400px; margin-left: 120px" class="chart-container text-center">
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Estado', 'Porcentaje'],
            ['Asistencia', {{ $porcentajeAsistencia }}],
            ['Ausencia', {{ $porcentajeAusencias }}]
        ]);

        var options = {
            is3D: true,
            pieHole: 0.3,
            colors: ['#28a745', '#dc3545']
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
</div>
  <h4 class="text-5xl text-center">Clases dadas: {{ $totalClases }} &nbsp&nbsp Clases asistidas: {{ $asistencias }} &nbsp&nbsp Clases perdidas: {{ $ausencias }}</h4>
</div>
<br><br>
</div>
<br><br><br><br><br><br><br>
@endsection