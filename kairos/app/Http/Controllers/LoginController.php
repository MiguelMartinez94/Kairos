<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Psicologo;

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
        $registro = Psicologo::create($request->all());
        return redirect()->route('psicologos.login')->with('success', 'Registro exitoso');
    }
}
