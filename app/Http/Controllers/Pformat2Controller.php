<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Models\TFormat2;

class Pformat2Controller extends Controller
{
    public function actVerifyData(Request $r)
    {
        $conSql = $this->connectionSql();
        if($conSql)
        {
            $script = "select InscriNro,Clinomx,Clilelx as dni from CONEXION where InscriNro='".$r->inscription."'";
            $stmt = sqlsrv_query($conSql, $script);
            $reg = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
            // dd(trim($reg['dni']),$r->dni,trim($reg['dni'])==$r->dni);
            if(!$reg)
                return response()->json(['state'=>false,'message'=>"No existe el numero de inscription: ".$r->ins]);
            if(trim($reg['dni'])==trim($r->dni))
                return response()->json(['state'=>true,'found' => true, 'reg' => $reg,'message'=>"El numero de dni de la inscripcion y el dni ingresado coinciden"]);
            else
                return response()->json(['state'=>true,'found' => false, 'reg' => $reg, 'dni' => $r->dni]);
        }
        return response()->json(['state'=>false,'message'=>"Error en la conexion, intentelo mas tarde."]);
    }
    public function borrar(Request $r)
    {

    }
}
