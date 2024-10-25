<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

use App\Models\TIns;

class InspectionsController extends Controller
{
    public function obtenerHorariosDisponiblesPorHora(Request $r)
    {
        // dd($this->startWork->format('H:i:s'),$this->endWork->format('H:i'));
        // Obtener horarios ocupados desde la base de datos
        $horariosOcupados = DB::table('inspections')
            ->where('dateIns', $r->dateIns)
            ->orderBy('startTime')
            ->get();
        // Definir horarios de inicio y fin del día laboral
        $horaInicioDia = $this->startWork;
        $horaFinDia = $this->endWork;
        $duracionMinima = 60;

        // Definir el rango de la hora de almuerzo (12:00 pm a 1:30 pm)
        $horaInicioAlmuerzo = Carbon::parse('12:00');
        $horaFinAlmuerzo = Carbon::parse('13:30');

        $horariosDisponibles = [];
        $horaLibreInicio = $horaInicioDia;

        $listTecnical = DB::table('tecnical')->get();

        for($i = 0;$i < $listTecnical->count();$i++)
        {
            $inspeccionesTecnico = $horariosOcupados->where('idTec', $listTecnical[$i]->idTec);

            foreach ($inspeccionesTecnico as $horario)
            {
                $idTec = $horario->idTec;
                $horaOcupadaInicio = Carbon::parse($horario->startTime);
                $horaOcupadaFin = Carbon::parse($horario->endTime);
                // Excluir la hora de almuerzo de 12:00 pm a 1:30 pm
                if ($horaLibreInicio->between($horaInicioAlmuerzo, $horaFinAlmuerzo)) {
                    $horaLibreInicio = $horaFinAlmuerzo;
                }
                // Verificar si hay un intervalo de al menos 1 hora entre los horarios ocupados
                if ($horaLibreInicio->diffInMinutes($horaOcupadaInicio) >= $duracionMinima) {
                    $horariosDisponibles[] = [
                        'tecnical' => $idTec,
                        'hora_inicio' => $horaLibreInicio->format('H:i'),
                        'hora_fin' => $horaOcupadaInicio->format('H:i')
                    ];
                }
                // Actualizar el inicio del próximo horario libre
                $horaLibreInicio = $horaOcupadaFin;
            }
            // Verificar el último intervalo libre entre el último horario ocupado y el fin del día
            if ($horaLibreInicio->between($horaInicioAlmuerzo, $horaFinAlmuerzo)) {
                $horaLibreInicio = $horaFinAlmuerzo;
            }
            // Verificar el último intervalo libre entre el último horario ocupado y el fin del día
            if ($horaLibreInicio->diffInMinutes($horaFinDia) >= $duracionMinima) {
                $horariosDisponibles[] = [
                    'tecnical' => $idTec,
                    'hora_inicio' => $horaLibreInicio->format('H:i'),
                    'hora_fin' => $horaFinDia->format('H:i')
                ];
            }
            $horaLibreInicio = $horaInicioDia;
        }
        return response()->json(['data' => $horariosDisponibles]);
    }
    public function obtenerFechasOcupadas()
    {
        // Obtener el número total de técnicos
        $totalTecnicos = DB::table('tecnical')->count();

        // Obtener las fechas donde todos los técnicos están ocupados completamente de 9am a 4pm
        $fechasOcupadas = DB::table('inspections')
            ->select('dateIns')
            ->where(function($query) {
                // Filtrar solo las inspecciones dentro del horario de trabajo 9am a 4pm
                $query->whereTime('startTime', '>=', $this->startWork->format('H:i:s'))
                    ->whereTime('endTime', '<=', $this->endWork->format('H:i:s'));
            })
            ->groupBy('dateIns')
            ->havingRaw('SUM(TIMESTAMPDIFF(HOUR, startTime, endTime)) >= ?', [7]) // 7 horas cubiertas
            ->havingRaw('COUNT(DISTINCT idTec) >= ?', [$totalTecnicos]) // Todos los técnicos están ocupados
            ->get()
            ->pluck('dateIns');

        // return response()->json($fechasOcupadas);
        return response()->json(['data' =>$fechasOcupadas]);
    }
    public function obtenerFechasOcupadas_new()
{
    // Definir las horas de trabajo
    $horaInicioTrabajo = $this->startWork->format('H:i:s');
    $horaFinTrabajo = $this->endWork->format('H:i:s');
    $horaInicioAlmuerzo = '12:00:00';
    $horaFinAlmuerzo = '13:30:00';

    // Obtener el número total de técnicos
    $totalTecnicos = DB::table('tecnical')->count();

    // Obtener las fechas donde todos los técnicos están ocupados completamente en el horario de trabajo
    $fechasOcupadas = DB::table('inspections')
        ->select('dateIns')
        ->where(function($query) use ($horaInicioTrabajo, $horaFinTrabajo, $horaInicioAlmuerzo, $horaFinAlmuerzo) {
            // Considerar solo las inspecciones dentro del horario de trabajo, excluyendo el tiempo de almuerzo
            $query->where(function($subquery) use ($horaInicioTrabajo, $horaInicioAlmuerzo) {
                // Horas antes del almuerzo
                $subquery->whereTime('startTime', '>=', $horaInicioTrabajo)
                         ->whereTime('endTime', '<=', $horaInicioAlmuerzo);
            })
            ->orWhere(function($subquery) use ($horaFinAlmuerzo, $horaFinTrabajo) {
                // Horas después del almuerzo
                $subquery->whereTime('startTime', '>=', $horaFinAlmuerzo)
                         ->whereTime('endTime', '<=', $horaFinTrabajo);
            });
        })
        ->groupBy('dateIns')
        ->havingRaw('SUM(TIMESTAMPDIFF(HOUR, startTime, endTime)) >= ?', [7.5]) // Asegurar 7.5 horas de trabajo (excluyendo el almuerzo)
        ->havingRaw('COUNT(DISTINCT idTec) >= ?', [$totalTecnicos]) // Asegurar que todos los técnicos están ocupados
        ->get()
        ->pluck('dateIns');

    return response()->json(['data' => $fechasOcupadas]);
}

    public function tecnicosDisponibles(Request $r)
    {
        // Rango de horas de trabajo (8am a 5pm)
        $horaInicio = $this->startWork->format('H:i:s');
        $horaFin = $this->endWork->format('H:i:s');

        // Obtener todos los técnicos
        $tecnicos = DB::table('tecnical')->get();

        // Obtener las inspecciones programadas para la fecha dada
        $inspecciones = DB::table('inspections')
            ->where('dateIns', $r->dateIns)
            ->orderBy('startTime')
            ->get();

        $tecnicosDisponibles = [];

        // Revisar cada técnico para ver si tiene disponibilidad
        foreach ($tecnicos as $tecnico) {
            // Obtener las inspecciones del técnico en esa fecha
            $inspeccionesTecnico = $inspecciones->where('idTec', $tecnico->idTec);

            // Revisar disponibilidad del técnico
            // $disponible = $this->verificarDisponibilidadTecnico($inspeccionesTecnico, $horaInicio, $horaFin);
            $disponible = $inspeccionesTecnico->isEmpty()?true:false;

            // Si está disponible, agregar a la lista
            if ($disponible) {
                $tecnicosDisponibles[] = $tecnico;
            }
        }

        // Devolver la lista de técnicos disponibles
        return response()->json(['data' => $tecnicosDisponibles]);
    }

}
