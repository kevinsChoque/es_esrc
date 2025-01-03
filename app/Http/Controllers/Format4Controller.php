<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;

use App\Models\TFormat2;
use App\Models\TFormat4;

class Format4Controller extends Controller
{
    public function actShow()
    {
        return view('format4/show');
    }
    public function actList()
    {
        $list = TFormat2::where('format2.process', '=', '3')
            ->leftjoin('inspections', 'inspections.idFo2', '=', 'format2.idFo2')
            ->leftjoin('format4', 'format4.idFo2', '=', 'format2.idFo2')
            ->select('format2.*','format4.idFo4','inspections.*')
            ->get();
        return response()->json(['data' => $list]);
    }
    public function actSave(Request $r)
    {
        // dd($r->all());
        $f2 = TFormat2::find($r->f4idFo2);
        // dd($f2);
        DB::beginTransaction();
        try {
            $existingRecord = TFormat4::where('idFo2', $r->f4idFo2)->first();
            if ($existingRecord)
            {
                $existingRecord->update([
                    'idFo2' => $r->f4idFo2,
                    'hourStart' => $r->hourStart,
                    'hourEnd' => $r->hourEnd,
                    'proEps' => $r->proEps,
                    'proRec' => $r->proRec,
                    'agreement' => $r->agreement,
                    'disagreement' => $r->disagreement,
                    // 'subsists' => Carbon::now(),
                ]);
                DB::commit();
                return response()->json(['state' => true, 'message' => 'Formato 4 actualizado correctamente']);
            }
            else
            {
                $r->merge([
                    'idFo2' => $r->f4idFo2,
                    'hourStart' => $r->hourStart,
                    'hourEnd' => $r->hourEnd,
                    'proEps' => $r->proEps,
                    'proRec' => $r->proRec,
                    'agreement' => $r->agreement,
                    'disagreement' => $r->disagreement,
                    // 'fr' => Carbon::now(),
                ]);
                $f4 = TFormat4::create($r->all());
                if ($f4)
                {
                    $f2->f4='1';
                    if($f2->save())
                    {
                        DB::commit();
                        return response()->json(['state' => true, 'message' => 'Formato 4 registrado correctamente']);
                    }
                    else
                    {
                        DB::rollBack();
                        return response()->json(['state' => false, 'message' => 'No fue posible actualizar el expediente.']);
                    }
                } else {
                    DB::rollBack();
                    return response()->json(['state' => false, 'message' => 'No fue posible registrar el formato 4']);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['state' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function actF4(Request $r)
    {
        $f4 = TFormat4::where('idFo2',$r->idFo2)->first();
        return response()->json(['state' => true, 'data' => $f4]);
    }
    public function actSaveFile(Request $r)
    {
        // dd($r->all());
        if ($r->hasFile('f4file') && $r->file('f4file')->getClientMimeType() !== 'application/pdf')
            return response()->json(['state' => false, 'message' => 'Ingrese un archivo válido.']);
        $nameFile = Carbon::now()->format('Ymd_His') . '_' . 'formato4.'.$r->file('f4file')->getClientOriginalExtension();
        $f2 = TFormat2::find($r->ff4idFo2);
        $pathFile = $f2->codRec;

        DB::beginTransaction();
        try {
            $existingRecord = TFormat4::where('idFo2', $r->ff4idFo2)->first();
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
        try {
            DB::beginTransaction();
            $f2 = TFormat2::where('codRec', $r->codRec)->first();
            if (!$f2)
                throw new Exception('No se encontró el registro de TFormat2.');
            $f4 = TFormat4::where('idFo2', $f2->idFo2)->first();
            if (!$f4)
                throw new Exception('No se encontró el registro de TFormat4.');
            $f2->process = 4;
            $f4->state = $r->stateConciliation;
            if (!$f2->save() || !$f4->save())
                throw new Exception('Error al guardar los cambios.');
            DB::commit();
            return response()->json(['state' => true,'message' => 'El reclamo ' . $r->codRec . ' se declaró como ' . $r->stateConciliation]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['state' => false,'message' => 'Ocurrió un error, por favor contacte con el administrador.']);
        }
    }
}
