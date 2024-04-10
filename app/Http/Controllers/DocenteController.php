<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Asignatura;
use App\Models\Asistencia;
use App\Models\User;

class DocenteController extends Controller {
    
    public function index() {

        //$usuario = Auth::user();
        //$registros = Asignatura::where('usuarios_idusuario', $usuario->id)->get();

        $usuario = 3;
        $registros = Asignatura::where('usuarios_idusuario', $usuario)->get();

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

    public function detalle($materiaId)
    {
        //$name = $request->get('buscar');
        //$users = User::where('name','like',"%$name%")->paginate(4);
        $users = User::all();
        //$usuario = Auth::user();
        $usuario = 3;
        $materia = Asignatura::find($materiaId);
        //$asistencias = Asignatura::where('usuarios_idusuario', $usuario->id)->get();

        $registros = Asignatura::where('usuarios_idusuario', $usuario)->get();
        $asistencias = Asistencia::all();

        $usuariosPresentes = Asistencia::pluck('usuarios_idusuario')->all();
        $usuariosAusentes = User::whereNotIn('id', $usuariosPresentes)->get();


        $resultados = collect();

        foreach ($asistencias as $asistencia) {
            $usuario = User::find($asistencia->usuarios_idusuario);
            $asignatura = Asignatura::find($asistencia->asignaturas_idasignatura);

            if($asignatura->id == $materiaId){
                $estado = in_array($usuario->id, $usuariosPresentes) ? 'Presente' : 'Ausente';

            $resultados->push([
            'nombre_usuario' => $usuario->name,
            'apellido_usuario' => $usuario->lastname,
            'nombre_asignatura' => $asignatura->materia,
            'fecha_asistencia' => $asistencia->fecha_asist,
            'estado' => $estado,
            ]);
          }
        }
        return view('docente.asistencias', ['resultados' => $resultados], ['materia' => $materia, 'users' => $users]);
    }

    public function curso() {
        //$usuario = Auth::user();
        //$registros = Asignatura::where('usuarios_idusuario', $usuario->id)->get();

        $usuario = 3;
        $registros = Asignatura::where('usuarios_idusuario', $usuario)->get();

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
        //return response()->json(['success' => true]);
    }
/*
    public function storeSeleccion(Request $request) {
        $input = $request->except('_token');
    
        $asignatura_id = $input['asignaturas_idasignatura'];
        $usuariosIds = $input['usuarios_idusuario'];
    
        foreach ($usuariosIds as $usuarioId) {
            $asistencia = new Asistencia();
            $asistencia->usuarios_idusuario = $usuarioId;
            $asistencia->asignaturas_idasignatura = $asignatura_id;
            $asistencia->save();
        }
        return redirect()->route('docente.asistencia')->with('success', 'Creado correctamente');
    }*/
}
