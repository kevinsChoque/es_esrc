<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;

use App\Exceptions\Exception;
use App\Models\TFormat2;
use App\Models\TFormat4;
use App\Models\TProcess;

class Format4Controller extends Controller
{
    public function actShow()
    {
        return view('format4/show');
    }
    public function actList()
    {
        // $list = TFormat2::where('format2.process', '=', '3')
        //     ->leftjoin('inspections', 'inspections.idFo2', '=', 'format2.idFo2')
        //     ->leftjoin('format4', 'format4.idFo2', '=', 'format2.idFo2')
        //     ->select('format2.*','format4.idFo4','inspections.*')
        //     ->get();
        $list = TProcess::where('format2.process', '=', '3')
            ->leftjoin('format2', 'format2.idFo2', '=', 'process.idFo2')
            ->leftjoin('inspections', 'inspections.idFo2', '=', 'format2.idFo2')
            ->leftjoin('format4', 'format4.idPro', '=', 'process.idPro')
            ->select('format2.*','format4.idFo4','inspections.*','process.*')
            ->whereIn('process.idPro', function ($query) {
                $query->selectRaw('MAX(idPro)')
                    ->from('process')
                    ->groupBy('process.idFo2'); // Agrupar por el campo que conecta con format2
            })
            ->get();
        return response()->json(['data' => $list]);
    }
    public function actSave(Request $request)
    {
        DB::beginTransaction();
        try {
            $pro = TProcess::findOrFail($request->f4idPro);
            $format2 = TFormat2::findOrFail($pro->idFo2);
            $format4 = TFormat4::updateOrCreate(
                ['idPro' => $request->f4idPro],
                $request->only(['hourStart', 'hourEnd', 'proEps', 'proRec', 'agreement', 'disagreement'])
            );
            if ($format4->wasRecentlyCreated || $format4->wasChanged())
            {
                $pro->f4 = '1';
                $pro->save();
            }
            DB::commit();
            $message = $format4->wasRecentlyCreated
                ? 'Formato 4 registrado correctamente'
                : 'Formato 4 actualizado correctamente';
            return response()->json(['state' => true, 'message' => $message, 'f2' => $format2]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['state' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function actF4(Request $r)
    {
        $f4 = TFormat4::where('idPro',$r->idPro)->first();
        return response()->json(['state' => true, 'data' => $f4]);
    }
    public function actSaveFile(Request $r)
    {
        // dd($r->all());
        if ($r->hasFile('f4file') && $r->file('f4file')->getClientMimeType() !== 'application/pdf')
            return response()->json(['state' => false, 'message' => 'Ingrese un archivo válido.']);
        $pro = TProcess::findOrFail($r->ff4idPro);
        $f2 = TFormat2::findOrFail($pro->idFo2);
        $nameFile = $f2->codRec.'_'.$pro->idPro. '_conciliacion.' . $r->file('f4file')->getClientOriginalExtension();
        $pathFile = 'reclamos/' . $f2->codRec;
        DB::beginTransaction();
        try {
            $existingRecord = TFormat4::where('idPro', $r->ff4idPro)->first();
            if ($existingRecord)
            {
                if (Storage::exists('public/'.$existingRecord->url))
                    Storage::delete('public/'.$existingRecord->url);
                $pathFile = $this->saveFileReg($r, 'f4file', $nameFile, $pathFile);
                $existingRecord->update(['url' => $pathFile]);
                DB::commit();
                return response()->json(['state' => true, 'message' => 'Formato 5 actualizado correctamente']);
            }
            DB::rollBack();
            return response()->json(['state' => false, 'message' => 'No se encontro el registro.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['state' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function actFile(Request $r,$idFo4)
    {
    	$f4 = TFormat4::find($idFo4);
        $pathFile = storage_path('app/public/'.$f4->url);
        if (file_exists($pathFile))
            return response()->file($pathFile);
        else
            abort(404);
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
        // dd($r->all());
        try {
            DB::beginTransaction();
            $pro = TProcess::where('idPro', $r->idPro)->first();
            $f2 = TFormat2::where('codRec', $pro->codRec)->first();
            if (!$f2)
                throw new \Exception('No se encontró el registro de TFormat2.');
            $f4 = TFormat4::where('idPro', $pro->idPro)->first();
            if (!$f4)
                throw new \Exception('No se encontró el registro de TFormat4.');
            $f2->process = 4;
            $f4->state = $r->stateConciliation;
            if (!$f2->save() || !$f4->save())
                throw new \Exception('Error al guardar los cambios.');
            DB::commit();
            return response()->json(['state' => true,'message' => 'El reclamo ' . $r->codRec . ' se declaró como ' . $r->stateConciliation]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['state' => false,'message' => 'Ocurrió un error, por favor contacte con el administrador.']);
        }
    }
}
