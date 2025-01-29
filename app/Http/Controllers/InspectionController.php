<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TFormat2;
use App\Models\TProcess;

class InspectionController extends Controller
{
    public function actShow()
    {return view('inspection/show');}
    public function actList()
    {
// -------------
// -------------
// -------------
        // $list = TProcess::where('format2.verify', '=', 1)
        //     ->where('format2.process', '=', '2')
        //     ->leftjoin('format2', 'format2.idFo2', '=', 'process.idFo2')
        //     ->leftjoin('inspections', 'inspections.idFo2', '=', 'format2.idFo2')
        //     ->leftjoin('format5', 'format5.idPro', '=', 'process.idPro')
        //     ->leftjoin('format6', 'format6.idPro', '=', 'process.idPro')
        //     ->leftjoin('format7', 'format7.idPro', '=', 'process.idPro')
        //     ->select('format2.*','inspections.*','format5.idFo5','format6.idFo6','format7.idFo7','process.*')
        //     ->get();
        $list = TProcess::where('format2.verify', '=', 1)
            ->where('format2.process', '=', '2')
            ->leftJoin('format2', 'format2.idFo2', '=', 'process.idFo2')
            ->leftJoin('inspections', 'inspections.idFo2', '=', 'format2.idFo2')
            ->leftJoin('format5', 'format5.idPro', '=', 'process.idPro')
            ->leftJoin('format6', 'format6.idPro', '=', 'process.idPro')
            ->leftJoin('format7', 'format7.idPro', '=', 'process.idPro')
            ->select('format2.*', 'inspections.*', 'format5.idFo5', 'format6.idFo6', 'format7.idFo7', 'process.*')
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
        $f2 = TFormat2::where('codRec',$r->codRec)->first();
        $f2->process = '3';
        if($f2->save())
            return response()->json(['state'=>true,'message'=>'El reclamo '.$r->codRec.' paso a la etapa de conciliacion.']);
        else
            return response()->json(['state'=>false,'message'=>'Error al cambiar el proceso']);
    }
}
