<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TFormat2;

use DB;

class OpcionesController extends Controller
{
    public function actShow()
    {return view('opciones/show');}
    public function actList()
    {
        $list = TFormat2::where('format2.process', '=', '5')
            ->leftjoin('format8', 'format8.idFo2', '=', 'format2.idFo2')
            ->leftjoin('format9', 'format9.idFo2', '=', 'format2.idFo2')
            ->select('format2.*','format8.idFo8','format9.idFo9')
            ->get();
        return response()->json(['data' => $list]);
    }
    public function actChangeProcess(Request $r)
    {
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
