<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Asistencia;
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
        // Obtener el código del formulario
        $codigoQR = $request->input('qr_value');
        $userId = $request->input('user_id');

        // Guardar el nuevo registro en la base de datos
        $Registro = new Asistencia;
        $Registro->usuarios_idusuario = 2;
        $Registro->asignaturas_idasignatura = $codigoQR;
        $Registro->save();
        return view('estudiante.index');
        //return response()->json(['success' => true]);
    }
    
    public function detalle($materiaId)
    {
        $usuario = Auth::user();
        $materia = Asignatura::find($materiaId);
        $asistencias = Asignatura::where('usuarios_idusuario', $usuario->id)->get();
        $asistencias = Asistencia::all();

        $usuariosPresentes = Asistencia::pluck('usuarios_idusuario')->all();
        $usuariosAusentes = User::whereNotIn('id', $usuariosPresentes)->get();

        $clasesTomadas = Asistencia::where('asignaturas_idasignatura', $materiaId)->count();

        $porcentaje = '';
        $clases = '';
        $asiste = '';
        $clasesP = '';

        foreach ($asistencias as $asistencia) {
            $usuario = User::find($asistencia->usuarios_idusuario);
            $asignatura = Asignatura::find($asistencia->asignaturas_idasignatura);

            if($asignatura->id == $materiaId){
                $estado = in_array($usuario->id, $usuariosPresentes) ? 'Presente' : 'Ausente';

                $asistenciasUsuario = Asistencia::where('usuarios_idusuario', $usuario->id)
                ->where('asignaturas_idasignatura', $materiaId)
                ->count();
                $porcentajeAsistencia = ($clasesTomadas > 0) ? ($asistenciasUsuario / $clasesTomadas) * 100 : 0;
                $clasesPerdidas = ($clasesTomadas - $asistenciasUsuario);

           /* 'nombre_usuario' => $usuario->name,
            'apellido_usuario' => $usuario->lastname,
            'nombre_asignatura' => $asignatura->materia,
            'fecha_asistencia' => $asistencia->fecha_asist,
            'asist_asistencia' => $asistencia->asistencia,
            'estado' => $estado,
            'clases_tomadas' => $clasesTomadas,
            'usuario_asistencia' => $asistenciasUsuario,
            'porcentaje_asistencia' => $porcentajeAsistencia,*/
            //$resultados .= "$porcentajeAsistencia\n";

         }
        }
        //$porcentajeAsistencia = ($clasesTomadas > 0) ? ($asistenciasUsuario / $clasesTomadas) * 100 : 0;
        $porcentaje = "$porcentajeAsistencia";
        $clases = "$clasesTomadas";
        $asiste = $asistenciasUsuario;
        $clasesP = $clasesPerdidas;
        return view('estudiante.detalles', ['porcentaje' => $porcentaje, 'clases' => $clases, 'asiste' => $asiste, 'clasesP' => $clasesP, 'materia' => $materia]);
    }

    public function curso() {
            $usuario = Auth::user();
            $registros = Asignatura::where('usuarios_idusuario', $usuario->id)->get();
            return view('estudiante.asignatura', compact('registros'));
    }  
}
