<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Asignatura;
use App\Models\Asistencia;
use App\Models\User;

class DocenteController extends Controller {
    
    public function index() {

        $usuario = Auth::user();
        $registros = Asignatura::where('usuarios_idusuario', $usuario->id)->get();

        return view('docente.index', compact('registros'));
    }

    public function show(string $id)
    {
        $datos = Asignatura::findOrFail($id);
        return view('docente.show', compact('datos'));
    }

    public function generarQR()
    {
        $codigoAleatorio = rand(10000, 99999);
        $nuevoCodigo = $codigoAleatorio;

        return response()->json(['codigo' => $nuevoCodigo]);
    }

    public function detalle(Request $request, $materia)
{
    $asignatura = Asignatura::where('code', $materia)->first();
    
    // Obtener los usuarios que pertenecen a la asignatura
    $usuarios = User::whereIn('id', function ($query) use ($asignatura) {
        $query->select('usuarios_idusuario')
            ->from('asignaturas')
            ->where('code', $asignatura->code);
    })->get();
    
    // Obtener la fecha seleccionada desde la solicitud
    $fechaSeleccionada = $request->input('fecha');

    // Filtrar los registros de asistencia según la asignatura y la fecha seleccionada
    $asistenciaQuery = Asistencia::where('asignaturas_idasignatura', $asignatura->code);

    if ($fechaSeleccionada) {
        $asistenciaQuery->whereDate('fecha_asist', Carbon::parse($fechaSeleccionada)->format('Y-m-d'));
    }

    $asistencia = $asistenciaQuery->get();

    // Crear colecciones para almacenar la asistencia y la fecha de registro de cada usuario
    $fechaClase = [];
    $usuariosAsistencia = [];

    foreach ($usuarios as $usuario){
        $fechaUser = $asistencia->where('usuarios_idusuario', $usuario->id)->first();
        
        if ($fechaUser) {
            $fechaClase[$usuario->id] = Carbon::parse($fechaUser->fecha_asist)->format('d-m-Y');
            $usuariosAsistencia[$usuario->id] = 'Presente';
        } else {
            $fechaClase[$usuario->id] = ' ';
            $usuariosAsistencia[$usuario->id] = 'Ausente';
        }
    }

    // Obtener todas las fechas disponibles (para el select del formulario)
    $fechasAsistencia = Asistencia::where('asignaturas_idasignatura', $asignatura->code)
        ->selectRaw('DATE(fecha_asist) as fecha_unica')
        ->distinct()
        ->orderBy('fecha_unica', 'asc')
        ->pluck('fecha_unica')
        ->map(function ($fecha) {
            return Carbon::parse($fecha)->format('d-m-Y');
        });
    
    return view('docente.asistencias', compact('usuarios', 'asistencia', 'asignatura', 'usuariosAsistencia', 'fechaClase', 'fechasAsistencia'));
}

    public function filtrarPorFecha(Request $request)
   {
    $fechaSeleccionada = $request->input('fecha');

    // Obtener la asignatura correspondiente (puedes ajustarlo según tu lógica)
    $asignatura = Asignatura::where('code', 'codigo_de_la_materia')->first();

    // Obtener los registros de asistencia para la fecha seleccionada
    $registrosAsistencia = Asistencia::where('asignaturas_idasignatura', $asignatura->id)
        ->whereDate('fecha_asist', $fechaSeleccionada)
        ->get();

    // Obtener todas las fechas disponibles (para el select del formulario)
    $fechasDisponibles = Asistencia::where('asignaturas_idasignatura', $asignatura->id)
        ->selectRaw('DATE(fecha_asist) as fecha')
        ->distinct()
        ->pluck('fecha');

    return view('docente.asistencias', compact('registrosAsistencia', 'fechasDisponibles'));
}

    

    public function curso() {
        $usuario = Auth::user();
        $registros = Asignatura::where('usuarios_idusuario', $usuario->id)->get();

        return view('docente.cursos', compact('registros'));
    }

    public function guardarRegistro(Request $request)
    {
        // Obtener el código del formulario
        $codigoQR = $request->input('qr_value');
        $userId = $request->input('user_id');

        // Guardar el nuevo registro en la base de datos
        $Registro = new Asistencia;
        $Registro->usuarios_idusuario = $userId;
        $Registro->asignaturas_idasignatura = $codigoQR;
        $Registro->save();
        return view('estudiante.index');
    }

    public function storeSeleccion(Request $request)
    {
        // Obtener los datos del formulario
        $materia = $request->input('code');
        $usuarios = $request->input('usuarios_idusuario');
    
        // Guardar la asistencia para cada usuario seleccionado
        foreach ($usuarios as $usuarioId) {
            Asistencia::create([
                'usuarios_idusuario' => $usuarioId,
                'asignaturas_idasignatura' => $materia,
                // Puedes agregar más campos aquí si es necesario
            ]);
        }
    
        // Redireccionar a una página de confirmación o a donde desees
        return redirect()->route('docente.index')->with('success', 'Asistencia guardada correctamente');
    }
}
