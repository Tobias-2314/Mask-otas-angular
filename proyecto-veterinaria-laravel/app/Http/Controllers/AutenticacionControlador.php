<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AutenticacionControlador extends Controller
{
    // Login
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $credenciales = $request->validate(['email' => 'required', 'password' => 'required']);
            
            if (Auth::attempt($credenciales)) {
                $request->session()->regenerate();
                return redirect('/');
            }
            return back()->withErrors(['email' => 'Datos incorrectos.']);
        }
        return view('auth.login');
    }

    // Registro
    public function registro(Request $request)
    {
        if ($request->isMethod('post')) {
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
        return view('auth.registro');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
