<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TFormat2;

class DesicionController extends Controller
{
    public function actShow()
    {return view('desicion/show');}
    public function actList()
    {
        $list = TFormat2::where('format2.process', '=', '4')
            ->leftjoin('format4', 'format4.idFo2', '=', 'format2.idFo2')
            ->select('format2.*','format4.idFo4')
            ->get();
        return response()->json(['data' => $list]);
    }
    public function actChangeProcess(Request $r)
    {
        // $state = $r->state=='fundado'?'4':($r->state=='infundado'?'5':'6');
        // $f2 = TFormat2::where('codRec',$r->codRec)->first();
        // $f4 = TFormat4::where('codRec',$f2->idFo2)->first();
        // $f2->process = 4;
        // $f4->state = $r->stateConciliation;
        // if($f2->save() && $f4->save())
        //     return response()->json(['state'=>true,'message'=>'El reclamo '.$r->codRec.' se declaro como '.$r->stateConciliation]);
        // else
        //     return response()->json(['state'=>false,'message'=>'Ocurrio un error, porfavor contactese con el administrador']);
        // ---------------
        // ---------------
        // ---------------
        try {
            DB::beginTransaction();
            $f2 = TFormat2::where('codRec', $r->codRec)->first();
            if (!$f2)
                throw new Exception('No se encontró el registro de TFormat2.');
            $f2->process = 5;
            if (!$f2->save())
                throw new Exception('Error al guardar los cambios.');
            DB::commit();
            return response()->json(['state' => true,'message' => 'El reclamo ' . $r->codRec . ' se declaró como ' . $r->stateConciliation]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['state' => false,'message' => 'Ocurrió un error, por favor contacte con el administrador.']);
        }
    }
}
