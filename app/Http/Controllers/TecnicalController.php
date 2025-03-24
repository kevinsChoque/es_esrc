<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\TTecnical;

class TecnicalController extends Controller
{
    public function actShow()
    {return view('tecnical/show');}
    public function actList()
    {
        $list = TTecnical::all();
        return response()->json(['data' => $list]);
    }
    public function actSaveList(Request $r)
    {
        try {
            $dnis = $r->disponibles;
            if (!is_array($dnis) || empty($dnis))
                return response()->json(['error' => 'Lista de DNIs inválida'], 400);
            DB::transaction(function () use ($dnis)
            {
                DB::table('tecnical')->update(['disponibilidadDia' => 0]);
                DB::table('tecnical')
                    ->whereIn('dni', $dnis)
                    ->update(['disponibilidadDia' => 1]);
            });
            return response()->json(['state' => true, 'message' => 'Disponibilidad actualizada'], 200);
        } catch (\Exception $e) {
            return response()->json(['state' => true, 'error' => $e->getMessage()], 500);
        }
    }
    public function actStartRegister()
    {
        try {
            $dnis = TTecnical::where('disponibilidadDia', 1)->pluck('dni');
            $jsonDisponibles = $dnis->toJson();
            DB::table('tecnicosdias')->insert([
                'fecha' => Carbon::now(),
                'disponibles' => $jsonDisponibles
            ]);
            return response()->json(['state' => true, 'message' => 'Se aperturo los registros de reclamos correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['state' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
