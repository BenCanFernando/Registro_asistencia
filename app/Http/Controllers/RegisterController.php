<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\UsersAudit;
use Illuminate\Http\Request;
use App\Models\User;


class RegisterController extends Controller {
    
    public function create() {
        
        return view('auth.register');
    }

    public function store() {

        $this->validate(request(), [
            'name' => 'required',
            'lastname' => 'required',
            'CI' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = User::create(request()->only(['name', 'lastname', 'CI', 'email', 'role', 'password']));

        $nombreUsuario = Auth::user()->name;
        $apellidoUsuario = Auth::user()->lastname;
        $nuevoUsuario = $user->CI;
        $nuevoRegistro = new UsersAudit();
        $nuevoRegistro->added_by = $nombreUsuario;
        $nuevoRegistro->added_last = $apellidoUsuario;
        $nuevoRegistro->user_ci = $nuevoUsuario;
        $nuevoRegistro->action = 'INSERT';
        $nuevoRegistro->save();

        return redirect()->to('/admin')->with('success', 'Usuario creado correctamente');
    }
}
