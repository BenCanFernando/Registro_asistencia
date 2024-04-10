<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class SessionsController extends Controller {
    public function create() {
        
        return view('auth.login');
    }

    public function store() {
        
        if(auth()->attempt(request(['email', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'El correo o la contraseña son incorrectas, por favor intente de nuevo',
            ]);

        } else {

            if(auth()->user()->state == 'Inactivo') {
                return back()->withErrors([
                'message' => 'No esposible acceder, la cuenta se encuentra inactiva',
               ]);
            }

                elseif(auth()->user()->role == 'Admin') {
                return redirect()->route('admin.index');
                }

                    elseif(auth()->user()->role == 'Docente') {
                    return redirect()->route('docente.index');
                    }

                        elseif(auth()->user()->role == 'Estudiante') {
                        return redirect()->route('estudiante.index');
                        }
        }
    }

    public function destroy() {

        auth()->logout();

        return redirect()->to('login');
    }
}

