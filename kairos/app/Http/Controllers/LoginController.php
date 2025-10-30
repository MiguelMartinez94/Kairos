<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Psicologo;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function loginPsicologos()
    {
        return view('login_psicologos.login');
    }

    public function registroPsicologos()
    {
        return view('login_psicologos.registrarse');
    }

    public function createRegistroPsicologo(Request $request)
    {
        $psicologo = Psicologo::create([

            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'password' => Hash::make($request->password)]
        );
        return redirect()->route('psicologos.login')->with('success', 'Registro exitoso');
    }

    public function login(Request $request)
    {
        
        $credenciales = $request->validate([
            'correo'   => 'required|email',
            'password' => 'required|string',
        ]);

        
        if (Auth::guard('psicologos')->attempt($credenciales)) {
            
            
            $request->session()->regenerate();

            
            return redirect()->intended(route('pacientes.activos'))->with('success', '¡Bienvenido de nuevo!');
        }

        return redirect()->route('psicologos.login')->with('danger', 'No se pudo iniciar sesión');
        
    }
}

