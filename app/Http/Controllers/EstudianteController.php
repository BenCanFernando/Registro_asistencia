<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Asistencia;
use App\Models\AsistenciasAudit;
use App\Models\Asignatura;
use App\Models\User;
use Illuminate\Http\Request;

class EstudianteController extends Controller {
    
    public function index() {

        return view('estudiante.index');
    }

    public function materias() {
        $usuario = Auth::user();
        $registros = Asignatura::where('usuarios_idusuario', $usuario->id)->get();
        return view('estudiante.asignatura', compact('registros'));
    }
    
    public function guardarRegistro(Request $request)
    {
        $usuario = Auth::user();
        $idUsuario = $usuario->id;
        // Obtener el código del formulario
        $codigoQR = $request->input('qr_value');
        $userId = $request->input('user_id');

        // Guardar el nuevo registro en la base de datos
        $Registro = new Asistencia;
        $Registro->usuarios_idusuario = $idUsuario;
        $Registro->asignaturas_idasignatura = $codigoQR;
        $Registro->save();

        $nombreUsuario = Auth::user()->name;
        $apellidoUsuario = Auth::user()->lastname;
        $CIUsuario = Auth::user()->CI;
        $nuevoRegistro = new AsistenciasAudit();
        $nuevoRegistro->nombre = $nombreUsuario;
        $nuevoRegistro->apellido = $apellidoUsuario;
        $nuevoRegistro->CI = $CIUsuario;
        $nuevoRegistro->save();


        return view('estudiante.index');
        //return response()->json(['success' => true]);
    }
    
    public function detalle($code)
    {
        $usuario = Auth::user();
        $materia = Asignatura::find($code);
    
        // Obtener todas las asistencias del usuario en la materia específica
        $asistenciasUsuario = Asistencia::where('usuarios_idusuario', $usuario->id)
            ->where('asignaturas_idasignatura', $code)
            ->get();
    
        // Contar la cantidad de asistencias
        $asistencias = $asistenciasUsuario->count();
    
        // Calcular el total de clases y el porcentaje de ausencias
        $totalClases = Asistencia::where('asignaturas_idasignatura', $code)->count();
        $ausencias = $totalClases - $asistencias;
        $porcentajeAsistencia = ($totalClases > 0) ? number_format(($asistencias / $totalClases) * 100, 1) : 0;
        $porcentajeAusencias = ($totalClases > 0) ? ($ausencias / $totalClases) * 100 : 0;
    
        // Retornar la vista con los datos necesarios
        return view('estudiante.detalles', [
            'asistencias' => $asistencias,
            'ausencias' => $ausencias,
            'porcentajeAsistencia' => $porcentajeAsistencia,
            'porcentajeAusencias' => $porcentajeAusencias,
            'totalClases' => $totalClases,
            'materia' => $materia
        ]);
    }
    
    
    public function curso() {
            $usuario = Auth::user();
            $registros = Asignatura::where('usuarios_idusuario', $usuario->id)->get();
            return view('estudiante.asignatura', compact('registros'));
    }  
}
