<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
            ->leftJoin('form3', 'form3.idPro', '=', 'process.idPro')
            ->select('format2.*', 'inspections.*', 'format5.idFo5', 'format6.idFo6', 'format7.idFo7','form3.idF3', 'process.*')
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
    public function actSaveDerivo(Request $r)
    {
        // dd($r->all());
        try {
            if (!$r->hasFile('fileDerivo') || $r->file('fileDerivo')->getClientMimeType() !== 'application/pdf')
                return response()->json(['state' => false, 'message' => 'Ingrese un archivo válido en formato PDF.']);
            $pro = TProcess::findOrFail($r->idPro);
            // Obtener el registro del formato 2
            $f2 = TFormat2::findOrFail($pro->idFo2); // Usar findOrFail para manejo automático de errores si no se encuentra
            $nameFile = $f2->codRec.'_'.$r->idPro.'_respuesta.'.$r->file('fileDerivo')->getClientOriginalExtension();
            $pathFile = 'reclamos/' . $f2->codRec;
            DB::beginTransaction();
            if ($pro->derivo && Storage::exists('public/' . $pro->derivo))
                Storage::delete('public/' . $pro->derivo);
            $newFilePath = $this->saveFileReg($r, 'fileDerivo', $nameFile, $pathFile);
            $pro->update(['fileDerivo' => $newFilePath,'oficina' => $r->oficina]);
            DB::commit();
            return response()->json(['state' => true, 'message' => 'Archivo subido correctamente.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['state' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function actFileDerivo(Request $r)
    {
        try {
            $pro = TProcess::find($r->idPro);
            if (!$pro)
                return response()->json(['state' => false, 'message' => 'El proceso no fue encontrado.'], 404);
            // $f2 = TFormat2::where('idFo2', $pro->idFo2)->where('pnumIns', $r->ins)->where('process', '<', 9)->first();
            // if (!$f2)
            //     return response()->json(['state' => false, 'message' => 'No se encontró un formato que cumpla las condiciones.'], 404);
            return response()->json(['state' => true, 'data' => $pro]);
        } catch (\Exception $e) {
            return response()->json(['state' => false, 'message' => 'Ocurrió un error inesperado: ' . $e->getMessage()], 500);
        }
    }
    public function actShowFileDerivo(Request $r,$idPro)
    {
    	$pro = TProcess::find($idPro);
        $pathFile = storage_path('app/public/'.$pro->fileDerivo);
        if (file_exists($pathFile))
            return response()->file($pathFile);
        else
            abort(404);
    }

}
