<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class MeetingsController extends Controller
{
    public function actGetavailable(Request $r)
    {
        $fecha = $r->dateReu;
        $limites = [
            '08:00AM - 10:00AM' => 3,
            '09:00AM - 11:00AM' => 3,
            '10:00AM - 12:00AM' => 2,
            '11:00AM - 01:00PM' => 1,
            '02:00PM - 03:30PM' => 3,
        ];
        // Consultar la base de datos para contar las reuniones ya registradas por cada horario en el día seleccionado
        $ocupados = DB::table('format2')
            ->select('horaReunion', DB::raw('COUNT(*) as cantidad'))
            ->whereDate('reunion', $fecha)
            ->groupBy('horaReunion')
            ->pluck('cantidad', 'horaReunion'); // Devuelve un array [hora => cantidad]
        // Filtrar las opciones disponibles
        $disponibles = [];
        foreach ($limites as $hora => $max)
        {
            if (!isset($ocupados[$hora]) || $ocupados[$hora] < $max)
                $disponibles[] = $hora;
        }
        // return response()->json($disponibles);
        return response()->json(['data' => $disponibles]);
    }

}
