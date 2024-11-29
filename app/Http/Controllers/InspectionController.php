<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TFormat2;

class InspectionController extends Controller
{
    public function actShow()
    {
        return view('inspection/show');
    }
    public function actList()
    {
        // $list = TFormat2::all();
        // $list = TFormat2::join('inspections', 'inspections.idFo2', '=', 'format2.idFo2')
        //     ->select('format2.*', 'inspections.*')
        //     ->where('format2.verify', '=', 1)
        //     ->get();
        // dd('aki');
        $list = TFormat2::where('format2.verify', '=', 1)
            ->where('format2.process', '=', '2')
            ->leftjoin('inspections', 'inspections.idFo2', '=', 'format2.idFo2')
            ->leftjoin('format5', 'format5.idFo2', '=', 'format2.idFo2')
            ->leftjoin('format6', 'format6.idFo2', '=', 'format2.idFo2')
            ->select('format2.*','inspections.*','format5.idFo5','format6.idFo6')
            ->get();
// dd('all');
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
