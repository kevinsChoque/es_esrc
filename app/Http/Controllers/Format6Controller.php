<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;

use App\Models\TFormat6;
use App\Models\TFormat2;

class Format6Controller extends Controller
{
    public function actF6(Request $r)
    {
        $f6 = TFormat6::where('idFo2',$r->idFo2)->where('inscription',$r->ins)->first();
        return response()->json(['state' => true, 'data' => $f6]);
    }
    public function actSave(Request $r)
    {
        // $pathFile = storage_path('app/public/'.'2024-1485/20241009_160649_formato5.pdf');
        // dd(file_exists($pathFile));
        // Verificar si el archivo es PDF
        if ($r->hasFile('f6file') && $r->file('f6file')->getClientMimeType() !== 'application/pdf') {
            return response()->json(['state' => false, 'message' => 'Ingrese un archivo válido.']);
        }

        $nameFile = Carbon::now()->format('Ymd_His') . '_' . 'formato6.'.$r->file('f6file')->getClientOriginalExtension();
        $f2 = TFormat2::find($r->f6idFo2);
        $pathFile = $f2->codRec;

        DB::beginTransaction();
        try {
            // Verificar si ya existe un registro con el idFo2
            $existingRecord = TFormat6::where('idFo2', $r->f6idFo2)->first();

            if ($existingRecord) {
                // Si existe, eliminar el archivo anterior
                if (Storage::exists('public/'.$existingRecord->url))
                    Storage::delete('public/'.$existingRecord->url);
                $pathFile = $this->saveFileReg($r, 'f6file', $nameFile, $pathFile);

                // Actualizar el registro con los nuevos datos y el nuevo archivo
                $existingRecord->update([
                    'inscription' => $r->f6ins,
                    'date' => $r->f6date,
                    'hour' => $r->f6hora,
                    'obs' => $r->f6obs,
                    'url' => $pathFile, // Actualizar con la nueva URL
                    'fr' => Carbon::now(),
                ]);

                DB::commit();
                return response()->json(['state' => true, 'message' => 'Formato 6 actualizado correctamente']);
            } else {
                // Si no existe, crear un nuevo registro
                $pathFile = $this->saveFileReg($r, 'f6file', $nameFile, $pathFile);
                $r->merge([
                    'idFo2' => $r->f6idFo2,
                    'inscription' => $r->f6ins,
                    'date' => $r->f6date,
                    'hour' => $r->f6hora,
                    'obs' => $r->f6obs,
                    'url' => $pathFile, // Guardar la nueva URL
                    'fr' => Carbon::now(),
                ]);

                $tf6 = TFormat6::create($r->all());

                if ($tf6)
                {
                    $f2->f6='1';
                    if($f2->save())
                    {
                        DB::commit();
                        return response()->json(['state' => true, 'message' => 'Formato 6 registrado correctamente']);
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
    public function actFile(Request $r,$idFo6)
    {
    	$f6 = TFormat6::find($idFo6);
        $pathFile = storage_path('app/public/'.$f6->url);
        if (file_exists($pathFile))
            return response()->file($pathFile);
        else
            abort(404);
    }
}
