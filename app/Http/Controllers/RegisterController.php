<?php

namespace App\Http\Controllers;

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
            'username' => 'required',
            'CI' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
        ]);

        $user = User::create(request(['name', 'lastname', 'username', 'CI', 'email', 'password', 'role']));

        auth()->login($user);
        return redirect()->to('/login');
    }
}
