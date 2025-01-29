<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

use App\Models\TFormat5;
use App\Models\TFormat2;
use App\Models\TProcess;

class Format5Controller extends Controller
{
    public function actSave_old(Request $r)
    {
        DB::beginTransaction();
        try {
            $existingRecord = TFormat5::updateOrCreate(
                ['idPro' => $r->f5idPro],
                [
                    'inscription' => $r->f5ins,
                    'date' => $r->f5date,
                    'hour' => $r->f5hora,
                    'obs' => $r->f5obs,
                    'fr' => Carbon::now(),
                ]
            );
            if ($existingRecord->wasRecentlyCreated || $existingRecord->wasChanged())
            {
                $pro = TProcess::find($r->f5idPro);
                $f2 = TFormat2::find($pro->idFo2);
                $f2->f5 = '1';
                if ($f2->save()) {
                    DB::commit();
                    $message = $existingRecord->wasRecentlyCreated
                        ? 'Formato 5 registrado correctamente'
                        : 'Formato 5 actualizado correctamente';
                    return response()->json(['state' => true, 'message' => $message, 'load' => ($f2->f5 == 1 && $f2->f6 == 1 ? true:false)]);
                }
            }
            DB::rollBack();
            return response()->json(['state' => false, 'message' => 'No fue posible actualizar el expediente.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['state' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function actSave(Request $r)
    {
        DB::beginTransaction();
        try {
            $existingRecord = TFormat5::updateOrCreate(
                ['idPro' => $r->f5idPro],
                [
                    'inscription' => $r->f5ins,
                    'date' => $r->f5date,
                    'hour' => $r->f5hora,
                    'obs' => $r->f5obs,
                    'fr' => Carbon::now(),
                ]
            );
            if ($existingRecord->wasRecentlyCreated || $existingRecord->wasChanged())
            {
                $pro = TProcess::find($r->f5idPro);
                if (!$pro)
                    throw new \Exception('Proceso no encontrado.');
                $pro->f5 = '1';
                if ($pro->save())
                {
                    DB::commit();
                    $load = ($pro->f5 == '1' && $pro->f6 == '1');
                    $message = $existingRecord->wasRecentlyCreated
                        ? 'Formato 5 registrado correctamente'
                        : 'Formato 5 actualizado correctamente';
                    return response()->json(['state' => true, 'message' => $message, 'load' => $load]);
                }
            }
            DB::rollBack();
            return response()->json(['state' => false, 'message' => 'No fue posible actualizar el expediente.']);
        } catch (\Exception $e) {
            DB::rollBack(); // Revertir la transacción en caso de error
            return response()->json([
                'state' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function actSave_last(Request $r)
    {
        // $pathFile = storage_path('app/public/'.'2024-1485/20241009_160649_formato5.pdf');
        // dd(file_exists($pathFile));
        // Verificar si el archivo es PDF

        // if ($r->hasFile('f5file') && $r->file('f5file')->getClientMimeType() !== 'application/pdf') {
        //     return response()->json(['state' => false, 'message' => 'Ingrese un archivo válido.']);
        // }
        // $nameFile = Carbon::now()->format('Ymd_His') . '_' . 'formato5.'.$r->file('f5file')->getClientOriginalExtension();
        // $f2 = TFormat2::find($r->f5idFo2);
        // $pathFile = $f2->codRec;

        DB::beginTransaction();
        try {
            $existingRecord = TFormat5::where('idFo2', $r->f5idFo2)->first();
            if ($existingRecord) {
                // Si existe, eliminar el archivo anterior
                // if (Storage::exists('public/'.$existingRecord->url))
                //     Storage::delete('public/'.$existingRecord->url);
                // $pathFile = $this->saveFileReg($r, 'f5file', $nameFile, $pathFile);
                // Actualizar el registro con los nuevos datos y el nuevo archivo
                $existingRecord->update([
                    'inscription' => $r->f5ins,
                    'date' => $r->f5date,
                    'hour' => $r->f5hora,
                    'obs' => $r->f5obs,
                    'fr' => Carbon::now(),
                ]);
                DB::commit();
                return response()->json(['state' => true, 'message' => 'Formato 5 actualizado correctamente']);
            } else {
                // Si no existe, crear un nuevo registro
                // $pathFile = $this->saveFileReg($r, 'f5file', $nameFile, $pathFile);
                $r->merge([
                    'idFo2' => $r->f5idFo2,
                    'inscription' => $r->f5ins,
                    'date' => $r->f5date,
                    'hour' => $r->f5hora,
                    'obs' => $r->f5obs,
                    'fr' => Carbon::now(),
                ]);
                $tf5 = TFormat5::create($r->all());
                if ($tf5)
                {
                    $f2->f5='1';
                    if($f2->save())
                    {
                        DB::commit();
                        return response()->json(['state' => true, 'message' => 'Formato 5 registrado correctamente']);
                    }
                    else
                    {
                        DB::rollBack();
                        return response()->json(['state' => false, 'message' => 'No fue posible actualizar el expediente.']);
                    }
                } else {
                    DB::rollBack();
                    return response()->json(['state' => false, 'message' => 'No fue posible registrar el formato 5']);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['state' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function actF5(Request $r)
    {
        $f5 = TFormat5::where('idPro',$r->idPro)->where('inscription',$r->ins)->first();
        return response()->json(['state' => true, 'data' => $f5]);
    }
    public function actFile(Request $r,$idFo5)
    {
    	$f5 = TFormat5::find($idFo5);
        $pathFile = storage_path('app/public/'.$f5->url);
        if (file_exists($pathFile))
            return response()->file($pathFile);
        else
            abort(404);
    }


}
