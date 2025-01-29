<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;

use App\Models\TFormat7;
use App\Models\TFormat2;
use App\Models\TProcess;

class Format7Controller extends Controller
{
    public function actF7(Request $r)
    {
        $f7 = TFormat7::where('idPro',$r->idPro)->where('inscription',$r->ins)->first();
        return response()->json(['state' => true, 'data' => $f7]);
    }
    public function actSave(Request $r)
    {
        DB::beginTransaction();
        try {
            $existingRecord = TFormat7::updateOrCreate(
                ['idPro' => $r->f7idPro],
                [
                    'inscription' => $r->f7ins,
                    'date' => $r->f7date,
                    'hour' => $r->f7hora,
                    'obs' => $r->f7obs,
                    'fr' => Carbon::now(),
                ]
            );
            if ($existingRecord->wasRecentlyCreated || $existingRecord->wasChanged())
            {
                $pro = TProcess::find($r->f7idPro);
                if (!$pro)
                    throw new \Exception('Proceso no encontrado.');
                $pro->f7 = '1';
                if ($pro->save())
                {
                    DB::commit();
                    $message = $existingRecord->wasRecentlyCreated
                        ? 'Formato 7 registrado correctamente'
                        : 'Formato 7 actualizado correctamente';
                    return response()->json(['state' => true, 'message' => $message]);
                }
            }
            DB::rollBack();
            return response()->json(['state' => false, 'message' => 'No fue posible actualizar el expediente.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['state' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
