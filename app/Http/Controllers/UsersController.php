<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

use App\Models\TUsers;

class UsersController extends Controller
{
    public function actShow()
    {return view('users/show');}
    public function actList()
    {
        $list = TUsers::where('tipo','!=','admin')->get();
        return response()->json(['data' => $list]);
    }
    public function actSave(Request $r)
    {
        try {
            $usu = TUsers::where('dni', $r->dni)->orWhere('correo', $r->correo)->first();
            if ($usu)
            {
                $message = $usu->dni == $r->dni
                    ? "El número de DNI: {$r->dni} ya fue registrado."
                    : "El usuario con correo: {$r->correo} ya fue registrado.";
                return response()->json(['state' => false, 'message' => $message]);
            }
            $r->merge([
                'password' => Hash::make($r->dni),
                'state' => '1',
                'fr' => Carbon::now(),
            ]);
            DB::transaction(function () use ($r)
            {
                TUsers::create($r->all());
            });
            return response()->json(['state' => true, 'message' => 'Usuario registrado correctamente']);
        } catch (\Exception $e) {
            return response()->json(['state' => false, 'message' => 'Error al registrar el usuario', 'error' => $e->getMessage()]);
        }
    }
    public function actEdit(Request $r)
    {
        $reg = TUsers::find($r->idUse);
        return response()->json(["data"=>$reg]);
    }
    public function actSaveChange(Request $r)
    {
        // dd($r->all());
        $use = TUsers::find($r->idUse);
        // dd($r->all(),$use);
        if($r->dni!=$use->dni)
        {
            $validateUse = TUsers::where('dni', $r->dni)->first();
            if($validateUse!=null)
                return response()->json(['state' => false, 'message' => 'El numero de DNI: '.$r->dni.' ya fue registrado.']);
        }
        $r->merge(['fa' => Carbon::now()]);
        $use->fill($r->all());
        if($use->save())
            return response()->json(['state' => true, 'message' => 'Se guardo los cambios.']);
        else
            return response()->json(['state' => false, 'message' => 'Ocurrio un error, porfavor contactese con el administrador.']);
    }
    public function actChangeAccess(Request $r)
    {
        // dd($r->all());
        $usu = TUsers::find($r->idUse);
        $usu->state = $usu->state=='1'?'0':'1';
        if($usu->save())
            return response()->json(['state'=>true,'message'=>($usu->state=='1'
            ?'Se dio acceso al usuario correctamente.'
            :'Se denegó el acceso al usuario correctamente.')]);
        else
            return response()->json(['state'=>false,'message'=>'Error al cambiar el proceso']);
    }
}
