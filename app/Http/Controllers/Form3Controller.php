<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

use App\Models\TForm3;
use App\Models\TProcess;

class Form3Controller extends Controller
{
    public function actF3(Request $r)
    {
        $f3 = TForm3::where('idPro',$r->idPro)->first();
        return response()->json(['state' => true, 'data' => $f3]);
    }
    public function actSave(Request $r)
    {
        // dd($r->all());
        DB::beginTransaction();
        try {
            $existingRecord = TForm3::updateOrCreate(
                ['idPro' => $r->f3idPro],
                [
                    'medidor' => $r->f3medidor,
                    'diametro' => $r->f3diametro,
                    'marca' => $r->f3marca,
                    'clase' => $r->f3clase,
                    'modelo' => $r->f3modelo,
                    'capacidad' => $r->f3capacidad,
                    'volumen' => $r->f3volumen,
                    'resultado' => $r->resultado,
                    'calificacion' => $r->calificacionMedidor,
                    'obs' => $r->f3obs,
                    'hora' => $r->f3hora,
                    'fr' => Carbon::now(),
                ]
            );
            if ($existingRecord->wasRecentlyCreated || $existingRecord->wasChanged())
            {
                $pro = TProcess::find($r->f3idPro);
                if (!$pro)
                    throw new \Exception('Proceso no encontrado.');
                $pro->f3 = '1';
                if ($pro->save())
                {
                    DB::commit();
                    return response()->json(['state' => true, 'message' => 'Se registro el FORMULARIO 3 correctamente.']);
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
}
