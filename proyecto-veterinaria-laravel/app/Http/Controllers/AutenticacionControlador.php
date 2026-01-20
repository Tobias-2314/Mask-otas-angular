<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AutenticacionControlador extends Controller
{
    // Mostrar formulario de login (GET)
    public function mostrarLogin()
    {
        return view('auth.login');
    }

    // Procesar login (POST)
    public function login(Request $request)
    {
        $credenciales = $request->validate(['email' => 'required', 'password' => 'required']);
        
        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();
            return redirect('/');
        }
        return back()->withErrors(['email' => 'Datos incorrectos.']);
    }

    // Mostrar formulario de registro (GET)
    public function mostrarRegistro()
    {
        return view('auth.registro');
    }

    // Procesar registro (POST)
    public function registro(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|unique:usuarios',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'contrasena' => Hash::make($request->password)
        ]);

        Auth::login($user);
        return redirect('/');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
