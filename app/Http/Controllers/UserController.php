<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Asignatura;
use App\Models\Curso;
use Flash;

class UserController extends Controller {
        
    public function materiaadd(Request $request) {
        $cursos = request()->except('_token');
        Asignatura::insert($cursos);
        Flash::success('Creado correctamente');
        return redirect (route('admin.index'));
    }
}
