<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Asignatura;
use App\Models\Curso;
use App\Models\UsersAudit;
use App\Models\AsistenciasAudit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Flash;

class AdminController extends Controller {
    
    public function index(Request $request)
    { 
        $CI = $request->get('buscar');
        $nombre = $request->get('buscar');
        $users = User::where('CI','like',"%$CI%")->paginate(4);
        $materias = Asignatura::where('materia','like',"%$nombre%")->paginate(4);
        $userAudit = UsersAudit::all();
        $asistenciaAudit = AsistenciasAudit::all();
        $cantuser = User::count();
        $cantdoc = User::where('role', 'Docente')->count();
        $cantest = User::where('role', 'Estudiante')->count();
        $cantcurso = Curso::count();
        $cantasi = Asignatura::all()->groupBy('cursos_idcurso');
        $cantasig = $cantasi->keys();
        $materiasString = $cantasig->implode(' ');
        $carreraUnica = Curso::select('carrera')->distinct()->get();
        $cantcarrera = $carreraUnica->count();
        return view('admin.index',compact(
        'users', 'userAudit', 'asistenciaAudit', 'cantuser', 'cantdoc','cantest', 'cantcurso', 'materiasString', 'materias', 'cantcarrera'));   
    }
    
    public function createuser() {

        return view('admin.createuser');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function store(Request $request)
    {
        $rules =[
            'name' => 'required',
            'lastname' => 'required',
            'ci' => 'required |numeric',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ];
            $mensaje =[
                'name.required' => 'El nombre es requerido',
                'lastname.required' => 'El apellido es requerido',
                'ci.required' => 'El número de cédula es requerido',
                'ci.numeric' => 'El número de cédula debe ser numérico',
                'email.required' => 'El correo es requerido',
                'password.required' => 'La contraseña es requerida',
                'role.required' => 'El rol del usuario es requerido',        
        ];
        $this->validate($request,$rules,$mensaje);
        $users= request()->except('_token');
        $insertar = new User();
        $insertar->name = $request->input('name');
        $insertar->lastname = $request->input('lastname');
        $insertar->CI = $request->input('ci');
        $insertar->email = $request->input('email');
        $insertar->username = $request->input('username');
        $insertar->password = Hash::make($request['password']);
        $insertar->role = $request->input('role');
        $insertar->save();
        
        return redirect()->route('admin.index')->with('success', 'Usuario creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */

     public function editUser($id)
     {   
        $user = User::find($id);
        return view ('admin.edituser', ['user' => $user]);
     }
 
     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function updateUser(Request $request, $id)
     {
        $rules =[
            'name' => 'required',
            'lastname' => 'required',
            'ci' => 'required|numeric',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ];
            $mensaje =[
                'name.required' => 'El nombre es requerido',
                'lastname.required' => 'El apellido es requerido',
                'ci.required' => 'El número de cédula es requerido',
                'ci.numeric' => 'El número de cédula debe ser numérico',
                'email.required' => 'El correo es requerido',
                'password.required' => 'La contraseña es requerida',
                'role.required' => 'El rol del usuario es requerido',
                
        ];
        $this->validate($request,$rules,$mensaje);

        $user = User::find($id);
        $user->update([
            'name' => $request->input('name'),
            'lastname' => $request->input('lastname'),
            'ci' => $request->input('ci'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => Hash::make($request['password']),
            'role' => $request->input('role'),
        ]);

        $nombreUsuario = Auth::user()->name;
        $apellidoUsuario = Auth::user()->lastname;
        $nuevoUsuario = $user->CI;
        $nuevoRegistro = new UsersAudit();
        $nuevoRegistro->added_by = $nombreUsuario;
        $nuevoRegistro->added_last = $apellidoUsuario;
        $nuevoRegistro->user_ci = $nuevoUsuario;
        $nuevoRegistro->action = 'UPDATE';
        $nuevoRegistro->save();

        return redirect()->route('admin.index')->with('success', 'Actualizado correctamente');
     }

    public function createmateria(Request $request)
    {
        $cursos = Curso::pluck('curso','id');
        $materias = Asignatura::pluck('materia', 'id');
        $carreras = Curso::all();
        $users = User::all();
        return view('admin.createmateria', compact('cursos', 'users', 'materias', 'carreras'));
    }

    public function storeSeleccion(Request $request) {
        $request->validate([
            'usuarios_idusuario' => 'required|array',
            'cursos_idcurso' => 'required|array',
            'materia' => 'required|string',
        ], [
            'usuarios_idusuario.required' => 'Debes seleccionar al menos un usuario.',
            'cursos_idcurso.required' => 'Debes seleccionar al menos un curso.',
            'materia.required' => 'El campo materia es obligatorio.',
        ]);

        $input = $request->except('_token');
        $usuariosIds = $input['usuarios_idusuario'];
        
        foreach ($usuariosIds as $usuarioId) {
            $asignatura = new Asignatura();
            $asignatura->usuarios_idusuario = $usuarioId;
            // Iterar sobre los cursos seleccionados
            foreach ($input['cursos_idcurso'] as $cursoId) {
                $asignatura = new Asignatura();
                $asignatura->usuarios_idusuario = $usuarioId;
                $asignatura->cursos_idcurso = $cursoId;
                $asignatura->materia = $input['materia'];
                $asignatura->save();
            }
        }
        return redirect()->route('admin.index')->with('success', 'Creado correctamente');
    }
    
    public function editMateria($id)
    {   $materia = Asignatura::findOrFail($id);
        $cursos = Curso::all();
        $usuarios = User::all();
        return view('admin.editmateria', compact('cursos', 'usuarios', 'materia'));
    }

public function updateMateria(Request $request, $id)
{
   /* $rules = [
        'materia' => 'required|string',
        'curso' => 'required',
        'usuario' => 'required',
    ];

    $messages = [
        'materia.required' => 'El nombre de la materia es requerido.',
        'materia.string' => 'El nombre de la materia debe ser una cadena de texto.',
        'curso.required' => 'Selecciona por lo menos un curso.',
        'usuario.required' => 'Selecciona por lo menos un usuario.',
    ];

    // Validar los datos recibidos
    $validator = Validator::make($request->all(), $rules, $messages);

    // Verificar si hay errores de validación
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }*/

    $materia = Asignatura::findOrFail($id);
    $materia->update($request->all());

    $nombreUsuario = Auth::user()->name;
        $nuevoRegistro = new UsersAudit();
        $nuevoRegistro->added_by = $request->input('added_by');
        $nuevoRegistro->nombre_usuario = $nombreUsuario;
        $nuevoRegistro->save();

    return redirect()->route('admin.index')->with('success', 'Materia actualizada correctamente');
}


    public function createcurso()
    {
        return view('admin.createcurso');
    }

   public function cursoadd(Request $request)
{
    $rules = [
        'nombre' => 'required',
        'carrera' => 'required|string',
        'facultad' => 'required|string',
    ];

    $messages = [
        'nombre.required' => 'El curso es requerido.',
        'nombre.max' => 'El nombre del curso no debe exceder los 255 caracteres.',
        'carrera.required' => 'El nombre de la carrera es requerida.',
        'carrera.string' => 'El nombre de la carrera debe ser una cadena de texto.',
        'facultad.required' => 'El nombre de la facultad es requerida.',
        'facultad.string' => 'El nombre de la facultad debe ser una cadena de texto.',
    ];

    // Validar los datos recibidos
    $validator = Validator::make($request->all(), $rules, $messages);

    // Verificar si hay errores de validación
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Si no hay errores de validación, insertar el curso en la base de datos
    Curso::create($request->all());

    return redirect()->route('admin.index')->with('success', 'Curso creado correctamente');
    }

    public function cambiarEstado(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'state' => 'required|in:Activo,Inactivo',
        ]);
        $registro = User::findOrFail($request->id);
        if ($request->state == 'Activo') {
            $registro->state = 'Inactivo';
        }

        if ($request->state == 'Inactivo') {
            $registro->state = 'Activo';
        }

        $registro->save();
        return back()->with('success', 'Estado cambiado exitosamente');
    }

    public function destroy($id)
    {
        $materia = $this->materiaRepository->find($id);

        if (empty($materia)) {
            Flash::error('Asignatura no encontrada');

            return redirect(route('admin.index'));
        }

        $this->materiaRepository->delete($id);

        return redirect()->route('admin.index')->with('success', 'Materia eliminada correctamente');
    }

    public function profile()
    {
        return view('admin.perfil');
    }
}
