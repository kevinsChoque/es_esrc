<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\TFormat9;
use App\Models\TFormat2;

use DB;

class Format9Controller extends Controller
{
    public function actEdit(Request $r)
    {
        // $f9 = TFormat9::where('idFo2',$r->idFo2)->first();
        $f9 = TFormat2::leftjoin('format9', 'format9.idFo2', '=', 'format2.idFo2')
            ->select('format2.*', 'format9.fundamento', 'format9.url', 'format9.idFo9')
            ->where('format2.idFo2',$r->idFo2)
            ->first();
        // dd($f9);
        if($f9)
            return response()->json(['state' => true, 'data' => $f9]);
        else
            return response()->json(['state' => false]);
    }
    public function actSave(Request $r)
    {
        if (!$r->hasFile('f9file') || $r->file('f9file')->getClientMimeType() !== 'application/pdf')
            return response()->json(['state' => false, 'message' => 'Ingrese un archivo válido.']);
        $f2 = TFormat2::find($r->f9idFo2);
        if (!$f2)
            return response()->json(['state' => false, 'message' => 'No se encontró el expediente.'], 404);
        DB::beginTransaction();
        try {
            $nameFile = $f2->codRec . '_f9_apelacion.' . $r->file('f9file')->getClientOriginalExtension();
            $pathFile = 'reclamos/' . $f2->codRec;
            $existingRecord = TFormat9::firstOrNew(['idFo2' => $r->f9idFo2]);
            // Si existe un archivo anterior, eliminarlo
            if ($existingRecord->exists && Storage::exists('public/' . $existingRecord->url))
                Storage::delete('public/' . $existingRecord->url);
            $pathFile = $this->saveFileReg($r, 'f9file', $nameFile, $pathFile);
            $existingRecord->fill([
                'fundamento' => $r->f9fundamento,
                'url' => $pathFile,
                'fa' => $existingRecord->exists ? Carbon::now() : null,
                'fr' => !$existingRecord->exists ? Carbon::now() : $existingRecord->fr,
            ])->save();
            $f2->f9 = '1';
            $f2->save();
            DB::commit();
            return response()->json([
                'state' => true,
                'message' => $existingRecord->wasRecentlyCreated ? 'Formato 9 registrado correctamente' : 'Formato 9 actualizado correctamente',
                'f2' => $f2,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['state' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function actSave_old(Request $r)
    {
        // Validar que el archivo sea PDF
        if ($r->hasFile('f9file') && $r->file('f9file')->getClientMimeType() !== 'application/pdf')
            return response()->json(['state' => false, 'message' => 'Ingrese un archivo válido.']);
        $f2 = TFormat2::find($r->f9idFo2);
        if (!$f2)
            return response()->json(['state' => false, 'message' => 'No se encontro el expediente.'], 404);
        $nameFile = $f2->codRec . '_formato9.' . $r->file('f9file')->getClientOriginalExtension();
        $pathFile = 'reclamos/' . $f2->codRec;
        DB::beginTransaction();
        try {
            $existingRecord = TFormat9::where('idFo2', $r->f9idFo2)->first();
            if ($existingRecord)
            {
                if (Storage::exists('public/' . $existingRecord->url))
                    Storage::delete('public/' . $existingRecord->url);
                $pathFile = $this->saveFileReg($r, 'f9file', $nameFile, $pathFile);
                $existingRecord->update([
                    'fundamento' => $r->f9fundamento,
                    'url' => $pathFile,
                    'fa' => Carbon::now(),
                ]);
                DB::commit();
                return response()->json(['state' => true, 'message' => 'Formato 9 actualizado correctamente', 'f2' => $f2]);
            }
            $pathFile = $this->saveFileReg($r, 'f9file', $nameFile, $pathFile);
            $newRecord = TFormat9::create([
                'idFo2' => $r->f9idFo2,
                'fundamento' => $r->f9fundamento,
                'url' => $pathFile,
                'fr' => Carbon::now(),
            ]);
            if ($newRecord)
            {
                $f2->f9 = '1';
                if ($f2->save())
                {
                    DB::commit();
                    return response()->json(['state' => true, 'message' => 'Formato 9 registrado correctamente', 'f2' => $f2]);
                }
                throw new \Exception('No fue posible actualizar el expediente.');
            }
            throw new \Exception('No fue posible registrar el formato 9.');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['state' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function actFile(Request $r,$idFo9)
    {
    	$f9 = TFormat9::find($idFo9);
        $pathFile = storage_path('app/public/'.$f9->url);
        if (file_exists($pathFile))
            return response()->file($pathFile);
        else
            abort(404);
    }
    public function actSave_del(Request $r)
    {
        // dd($r->all());
        // $pathFile = storage_path('app/public/'.'2024-1485/20241009_160649_formato5.pdf');
        if ($r->hasFile('f9file') && $r->file('f9file')->getClientMimeType() !== 'application/pdf')
            return response()->json(['state' => false, 'message' => 'Ingrese un archivo válido.']);
        $f2 = TFormat2::find($r->f9idFo2);
        $nameFile = $f2->codRec. '_formato9.'.$r->file('f9file')->getClientOriginalExtension();
        $pathFile = 'reclamos/'.$f2->codRec;

        DB::beginTransaction();
        try {
            // Verificar si ya existe un registro con el idFo2
            $existingRecord = TFormat9::where('idFo2', $r->f9idFo2)->first();
            if ($existingRecord) {
                // Si existe, eliminar el archivo anterior
                if (Storage::exists('public/'.$existingRecord->url))
                    Storage::delete('public/'.$existingRecord->url);
                $pathFile = $this->saveFileReg($r, 'f9file', $nameFile, $pathFile);
                $existingRecord->update([
                    'fundamento' => $r->f9fundamento,
                    'url' => $pathFile,
                    'fa' => Carbon::now(),
                ]);
                DB::commit();
                return response()->json(['state' => true, 'message' => 'Formato 9 actualizado correctamente']);
            } else {
                // Si no existe, crear un nuevo registro
                $pathFile = $this->saveFileReg($r, 'f9file', $nameFile, $pathFile);
                $r->merge([
                    'idFo2' => $r->f9idFo2,
                    'fundamento' => $r->f9fundamento,
                    'url' => $pathFile,
                    'fr' => Carbon::now(),
                ]);
                $f9 = TFormat9::create($r->all());
                if($f9)
                {
                    $f2->f9='1';
                    if($f2->save())
                    {
                        DB::commit();
                        return response()->json(['state' => true, 'message' => 'Formato 9 registrado correctamente']);
                    }
                    else
                    {
                        DB::rollBack();
                        return response()->json(['state' => false, 'message' => 'No fue posible actualizar el expediente.']);
                    }
                } else {
                    DB::rollBack();
                    return response()->json(['state' => false, 'message' => 'No fue posible registrar el formato 9']);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['state' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
