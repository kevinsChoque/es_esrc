<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\TUsers;

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
        // return response()->json(['estado' => true, 'message' => 'ok']);
        // dd($r->all());
    	$use = TUsers::where('dni',$r->usuario)->first();
        if($use==null)
    	{  return response()->json(['state' => false, 'message' => 'El usuario no se encuentra registrado.']);}
        if($use->state=='0')
        {   return response()->json(['state' => false, 'message' => 'El usuario '.$r->usuario.' no cuenta con acceso al sistema.']);}
    	if(!Hash::check($r->password, $use->password))
    	{  return response()->json(['state' => false, 'message' => 'La contraseña es incorrecta.']);}
    	session(['use' => $use]);
    	return response()->json(['state' => true, 'message' => 'ok']);
    }
    public function actLogout(Request $r)
    {
    	session()->flush();
    	return redirect('login/login');
    }
}
