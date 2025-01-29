<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TFormat2;
use App\Models\TProcess;
use DB;

class DesicionController extends Controller
{
    public function actShow()
    {return view('desicion/show');}
    public function actList()
    {
        $list = TProcess::where('format2.process', '=', '4')
            ->leftjoin('format2', 'format2.idFo2', '=', 'process.idFo2')
            ->leftjoin('format4', 'format4.idPro', '=', 'process.idPro')
            ->leftjoin('inspections', 'inspections.idFo2', '=', 'format2.idFo2')
            ->select('format2.*','format4.idFo4','inspections.*','process.*')
            ->whereIn('process.idPro', function ($query) {
                $query->selectRaw('MAX(idPro)')
                    ->from('process')
                    ->groupBy('process.idFo2'); // Agrupar por el campo que conecta con format2
            })
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
            return response()->json(['state' => true,'message' => 'El reclamo ' . $r->codRec . ' se declaró como finalizado.']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['state' => false,'message' => 'Ocurrió un error, por favor contacte con el administrador.']);
        }
    }
}
