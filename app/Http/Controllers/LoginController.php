<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function actLogin()
    {
        if (Session::has('user'))
            return redirect('/home/home');
        else
            return view('login/login');
    }
    public function actSigin(Request $r)
    {
        return response()->json(['estado' => true, 'message' => 'ok']);
    	$tUsu = TUsuario::where('usuario',$r->usuario)->first();
        // validacion de usuario para ver si esta inactivo
        if($tUsu->estado=='0')
        {   return response()->json(['estado' => false, 'message' => 'El usuario '.$r->usuario.' no cuenta con acceso al sistema.']);}
        // validacion de usuario para ver siexiste
    	if($tUsu==null)
    	{  return response()->json(['estado' => false, 'message' => 'El usuario no se encuentra registrado.']);}
        // validacion de usuario para ver si la contraseña es la correcta
    	if(!Hash::check($r->password, $tUsu->password))
    	{  return response()->json(['estado' => false, 'message' => 'La contraseña es incorrecta.']);}
        // guardado en sesion el usuario logueado
    	session(['usuario' => $tUsu]);
        $this->historial($r);
    	return response()->json(['estado' => true, 'message' => 'ok']);
    }
}
