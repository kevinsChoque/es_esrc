<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\TFormat8;
use App\Models\TFormat2;

use DB;

class Format8Controller extends Controller
{
    public function actEdit(Request $r)
    {
        // $f8 = TFormat8::where('idFo2',$r->idFo2)->first();
        $f8 = TFormat2::leftjoin('format8', 'format8.idFo2', '=', 'format2.idFo2')
            ->select('format2.*', 'format8.fundamento', 'format8.url', 'format8.idFo8')
            ->where('format2.idFo2',$r->idFo2)
            ->first();
        // dd($f8);
        if($f8)
            return response()->json(['state' => true, 'data' => $f8]);
        else
            return response()->json(['state' => false]);
    }
    public function actSave(Request $r)
    {
        // Validar que el archivo sea PDF
        if ($r->hasFile('f8file') && $r->file('f8file')->getClientMimeType() !== 'application/pdf')
            return response()->json(['state' => false, 'message' => 'Ingrese un archivo válido.']);
        $f2 = TFormat2::find($r->f8idFo2);
        if (!$f2)
            return response()->json(['state' => false, 'message' => 'No se encontro el expediente.'], 404);
        $nameFile = $f2->codRec . '_formato8.' . $r->file('f8file')->getClientOriginalExtension();
        $pathFile = 'reclamos/' . $f2->codRec;
        DB::beginTransaction();
        try {
            $existingRecord = TFormat8::where('idFo2', $r->f8idFo2)->first();
            if ($existingRecord)
            {
                if (Storage::exists('public/' . $existingRecord->url))
                    Storage::delete('public/' . $existingRecord->url);
                $pathFile = $this->saveFileReg($r, 'f8file', $nameFile, $pathFile);
                $existingRecord->update([
                    'fundamento' => $r->f8fundamento,
                    'url' => $pathFile,
                    'fa' => Carbon::now(),
                ]);
                DB::commit();
                return response()->json(['state' => true, 'message' => 'Formato 8 actualizado correctamente']);
            }
            $pathFile = $this->saveFileReg($r, 'f8file', $nameFile, $pathFile);
            $newRecord = TFormat8::create([
                'idFo2' => $r->f8idFo2,
                'fundamento' => $r->f8fundamento,
                'url' => $pathFile,
                'fr' => Carbon::now(),
            ]);
            if ($newRecord)
            {
                $f2->f8 = '1';
                if ($f2->save())
                {
                    DB::commit();
                    return response()->json(['state' => true, 'message' => 'Formato 8 registrado correctamente']);
                }
                throw new \Exception('No fue posible actualizar el expediente.');
            }
            throw new \Exception('No fue posible registrar el formato 8.');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['state' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function actFile(Request $r,$idFo8)
    {
    	$f8 = TFormat8::find($idFo8);
        $pathFile = storage_path('app/public/'.$f8->url);
        if (file_exists($pathFile))
            return response()->file($pathFile);
        else
            abort(404);
    }
    public function actSave_del(Request $r)
    {
        // dd($r->all());
        // $pathFile = storage_path('app/public/'.'2024-1485/20241008_160648_formato5.pdf');
        if ($r->hasFile('f8file') && $r->file('f8file')->getClientMimeType() !== 'application/pdf')
            return response()->json(['state' => false, 'message' => 'Ingrese un archivo válido.']);
        $f2 = TFormat2::find($r->f8idFo2);
        $nameFile = $f2->codRec. '_formato8.'.$r->file('f8file')->getClientOriginalExtension();
        $pathFile = 'reclamos/'.$f2->codRec;

        DB::beginTransaction();
        try {
            // Verificar si ya existe un registro con el idFo2
            $existingRecord = TFormat8::where('idFo2', $r->f8idFo2)->first();
            if ($existingRecord) {
                // Si existe, eliminar el archivo anterior
                if (Storage::exists('public/'.$existingRecord->url))
                    Storage::delete('public/'.$existingRecord->url);
                $pathFile = $this->saveFileReg($r, 'f8file', $nameFile, $pathFile);
                $existingRecord->update([
                    'fundamento' => $r->f8fundamento,
                    'url' => $pathFile,
                    'fa' => Carbon::now(),
                ]);
                DB::commit();
                return response()->json(['state' => true, 'message' => 'Formato 8 actualizado correctamente']);
            } else {
                // Si no existe, crear un nuevo registro
                $pathFile = $this->saveFileReg($r, 'f8file', $nameFile, $pathFile);
                $r->merge([
                    'idFo2' => $r->f8idFo2,
                    'fundamento' => $r->f8fundamento,
                    'url' => $pathFile,
                    'fr' => Carbon::now(),
                ]);
                $f8 = TFormat8::create($r->all());
                if($f8)
                {
                    $f2->f8='1';
                    if($f2->save())
                    {
                        DB::commit();
                        return response()->json(['state' => true, 'message' => 'Formato 8 registrado correctamente']);
                    }
                    else
                    {
                        DB::rollBack();
                        return response()->json(['state' => false, 'message' => 'No fue posible actualizar el expediente.']);
                    }
                } else {
                    DB::rollBack();
                    return response()->json(['state' => false, 'message' => 'No fue posible registrar el formato 8']);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['state' => false, 'message' => $e->getMessage()], 500);
        }
    }
}