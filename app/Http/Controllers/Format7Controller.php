<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;

use App\Models\TFormat7;
use App\Models\TFormat2;

class Format7Controller extends Controller
{
    public function actF7(Request $r)
    {
        $f7 = TFormat7::where('idFo2',$r->idFo2)->where('inscription',$r->ins)->first();
        return response()->json(['state' => true, 'data' => $f7]);
    }
    public function actSave(Request $r)
    {
        // dd($r->all());
        DB::beginTransaction();
        try {
            $existingRecord = TFormat7::updateOrCreate(
                ['idFo2' => $r->f7idFo2],
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
                $f2 = TFormat2::find($r->f7idFo2);
                $f2->f7 = '1';
                if ($f2->save()) {
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
