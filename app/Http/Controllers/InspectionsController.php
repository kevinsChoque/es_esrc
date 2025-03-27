<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use DB;

use App\Models\TIns;
use App\Models\TFormat2;

class InspectionsController extends Controller
{
    public function obtenerHorariosDisponiblesPorHora(Request $r)
    {
        // Definir los horarios fijos
        $horariosFijos = [
            '08:00AM - 10:00AM',
            '10:00AM - 12:00AM',
            '02:00PM - 04:00PM',
            '03:00PM - 05:00PM',
        ];

        // Obtener los técnicos
        // $listTecnical = DB::table('tecnical')->get();
        $listTecnical = DB::table('tecnical')->where('disponibilidadDia','1')->get();

        // Obtener inspecciones programadas para esa fecha
        $horariosOcupados = DB::table('inspections')
            ->where('dateIns', $r->dateIns)
            ->get();

        $horariosDisponibles = [];

        foreach ($listTecnical as $tecnico) {
            // Obtener inspecciones del técnico en esa fecha
            $inspeccionesTecnico = $horariosOcupados->where('idTec', $tecnico->idTec);

            // Contar inspecciones por horario
            $conteoPorHorario = $inspeccionesTecnico->groupBy('horario')->map->count();

            // Revisar cada horario fijo
            foreach ($horariosFijos as $horario) {
                // Verificar si el técnico tiene menos de 2 inspecciones en ese horario
                if ($conteoPorHorario->get($horario, 0) < 2) {
                    $horariosDisponibles[] = [
                        'tecnical' => $tecnico->idTec,
                        'horario' => $horario
                    ];
                }
            }
        }

        return response()->json(['data' => $horariosDisponibles]);
    }

    public function obtenerHorariosDisponiblesPorHora_last(Request $r)
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
        // Obtener la fecha actual y los próximos 2 días
        $today = Carbon::today();
        $twoDaysLater = $today->copy()->addDays(2);
        // Horarios clave
        $horariosClave = [
            '08:00AM - 10:00AM',
            '10:00AM - 12:00AM',
            '02:00PM - 04:00PM',
            '03:00PM - 05:00PM',
        ];
        // Obtener fechas de inspecciones dentro del rango de los dos días siguientes
        $fechasInspecciones = DB::table('inspections')
            ->select('dateIns')
            ->distinct()
            ->whereBetween('dateIns', [$today, $twoDaysLater])
            ->pluck('dateIns');
        // Obtener técnicos disponibles
        $tecnicosDisponibles = DB::table('tecnical')->where('disponibilidadDia', '1')->count();
        $fechasOcupadas = [];
        foreach ($fechasInspecciones as $fecha)
        {
            $tecnicosEnFecha = DB::table('inspections')
                ->where('dateIns', $fecha)
                ->select('idTec', 'horario')
                ->get()
                ->groupBy('idTec');
            if ($tecnicosEnFecha->count() < $tecnicosDisponibles)
                continue; // Si no están todos los técnicos disponibles, la fecha no está ocupada
            $fechaOcupada = true;
            foreach ($tecnicosEnFecha as $inspecciones)
            {
                $inspeccionesPorHorario = array_fill_keys($horariosClave, 0);
                foreach ($inspecciones as $inspeccion)
                {
                    if (array_key_exists($inspeccion->horario, $inspeccionesPorHorario))
                        $inspeccionesPorHorario[$inspeccion->horario]++;
                }
                // Verificar que el técnico tenga dos inspecciones en cada horario clave
                if (!collect($inspeccionesPorHorario)->every(fn($count) => $count >= 2))
                {
                    $fechaOcupada = false;
                    // break;
                }
            }
            if ($fechaOcupada)
                $fechasOcupadas[] = $fecha;
        }
        return response()->json(['data' => $fechasOcupadas]);
    }

    public function obtenerFechasOcupadas_unmomento()
    {
        // Horarios laborales y almuerzo
        $startWork = '08:00:00';
        $lunchStart = '12:00:00';
        $lunchEnd = '14:00:00';
        $endWork = '17:00:00';
        // Obtener la fecha de hoy y los próximos dos días
        $hoy = Carbon::today();
        $pasadoManana = Carbon::today()->addDays(2);

        // Obtener las fechas de inspecciones solo de los próximos dos días
        $fechasInspecciones = DB::table('inspections')
            ->select('dateIns')
            ->whereBetween('dateIns', [$hoy, $pasadoManana])
            ->distinct()
            ->pluck('dateIns');
        foreach ($fechasInspecciones as $fecha)
        {
            $tecnicosEnFecha = DB::table('inspections')
                ->where('dateIns', $fecha)
                ->select('idTec', 'startTime', 'endTime')
                ->orderBy('startTime')
                ->get()
                ->groupBy('idTec');
            // $tecnicosEnFecha = $this->tecnicosEnFecha(true);
            $fechaOcupada = true;
            foreach ($tecnicosEnFecha as $idTec => $inspecciones)
            {
                // Calcular los intervalos libres del técnico
                $intervalosLibres = [];
                // Inicializar con el inicio del día laboral
                $ultimoFin = $startWork;
                foreach ($inspecciones as $inspeccion) {
                    // Si hay un espacio antes del almuerzo
                    if ($ultimoFin < $lunchStart && $inspeccion->startTime > $ultimoFin)
                    {
                        $finIntervalo = min($lunchStart, $inspeccion->startTime);
                        $intervalosLibres[] = [$ultimoFin, $finIntervalo];
                    }
                    // Si hay un espacio después del almuerzo
                    if ($inspeccion->endTime < $lunchEnd)
                        $ultimoFin = $lunchEnd;
                    else
                        $ultimoFin = max($ultimoFin, $inspeccion->endTime);
                }
                // Agregar el intervalo final hasta el final del día laboral
                if ($ultimoFin < $endWork)
                    $intervalosLibres[] = [$ultimoFin, $endWork];
                // Verificar si existe al menos un intervalo libre de 2 horas
                $tieneEspacio = false;
                foreach ($intervalosLibres as [$inicio, $fin])
                {
                    $duracion = (strtotime($fin) - strtotime($inicio)) / 3600; // En horas
                    if ($duracion >= 2)
                    {
                        $tieneEspacio = true;
                        break;
                    }
                }
                if ($tieneEspacio)
                {
                    $fechaOcupada = false;
                    break;
                }
            }
            if ($fechaOcupada)
                $fechasOcupadas[] = $fecha;
        }
        // $fechasOcupadas[] = '2024-12-09';
        return response()->json(['data' => $fechasOcupadas]);
    }

    //esto esta funcionando antes, se cambiara solo por los 2 dias siguientes
    public function obtenerFechasOcupadas_last()
    {
        // Horarios laborales y almuerzo
        $startWork = '08:00:00';
        $lunchStart = '12:00:00';
        $lunchEnd = '14:00:00';
        $endWork = '17:00:00';
        // Obtener todas las fechas de inspecciones
        $fechasInspecciones = DB::table('inspections')
            ->select('dateIns')
            ->distinct()
            ->pluck('dateIns');
        // Obtener el número total de técnicos
        $totalTecnicos = DB::table('tecnical')->count();
        $fechasOcupadas = [];
        foreach ($fechasInspecciones as $fecha)
        {
            $tecnicosEnFecha = DB::table('inspections')
                ->where('dateIns', $fecha)
                ->select('idTec', 'startTime', 'endTime')
                ->orderBy('startTime')
                ->get()
                ->groupBy('idTec');
            // $tecnicosEnFecha = $this->tecnicosEnFecha(true);
            $fechaOcupada = true;
            foreach ($tecnicosEnFecha as $idTec => $inspecciones)
            {
                // Calcular los intervalos libres del técnico
                $intervalosLibres = [];
                // Inicializar con el inicio del día laboral
                $ultimoFin = $startWork;
                foreach ($inspecciones as $inspeccion) {
                    // Si hay un espacio antes del almuerzo
                    if ($ultimoFin < $lunchStart && $inspeccion->startTime > $ultimoFin)
                    {
                        $finIntervalo = min($lunchStart, $inspeccion->startTime);
                        $intervalosLibres[] = [$ultimoFin, $finIntervalo];
                    }
                    // Si hay un espacio después del almuerzo
                    if ($inspeccion->endTime < $lunchEnd)
                        $ultimoFin = $lunchEnd;
                    else
                        $ultimoFin = max($ultimoFin, $inspeccion->endTime);
                }
                // Agregar el intervalo final hasta el final del día laboral
                if ($ultimoFin < $endWork)
                    $intervalosLibres[] = [$ultimoFin, $endWork];
                // Verificar si existe al menos un intervalo libre de 2 horas
                $tieneEspacio = false;
                foreach ($intervalosLibres as [$inicio, $fin])
                {
                    $duracion = (strtotime($fin) - strtotime($inicio)) / 3600; // En horas
                    if ($duracion >= 2)
                    {
                        $tieneEspacio = true;
                        break;
                    }
                }
                if ($tieneEspacio)
                {
                    $fechaOcupada = false;
                    break;
                }
            }
            if ($fechaOcupada)
                $fechasOcupadas[] = $fecha;
        }
        // $fechasOcupadas[] = '2024-12-09';
        return response()->json(['data' => $fechasOcupadas]);
    }
    public function actGetTecnicalavailable(Request $r)
    {
        $fecha = $r->dateIns;
        $limites = [
            '08:00AM - 10:00AM' => 2,
            '10:00AM - 12:00AM' => 2,
            '02:00PM - 04:00PM' => 2,
            '03:00PM - 05:00PM' => 2,
        ];
        // Consultar la base de datos para contar las reuniones ya registradas por cada horario en el día seleccionado
        $ocupados = DB::table('inspections')
            ->select('horario', DB::raw('COUNT(*) as cantidad'))
            ->whereDate('dateIns', $fecha)
            ->groupBy('horario')
            ->pluck('cantidad', 'horario'); // Devuelve un array [hora => cantidad]
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
    // esto se usaba antes
    public function tecnicosDisponibles_last(Request $r)
    {
        // Rango de horas de trabajo (8am a 5pm)
        // $horaInicio = $this->startWork->format('H:i:s');
        // $horaFin = $this->endWork->format('H:i:s');

        // Obtener todos los técnicos
        $tecnicos = DB::table('tecnical')->get();

        // Obtener las inspecciones programadas para la fecha dada
        $inspecciones = DB::table('inspections')
            ->where('dateIns', $r->dateIns)
            ->orderBy('startTime')
            ->get();

        // dd($horaInicio,$horaFin,$tecnicos,$inspecciones);

        $tecnicosDisponibles = [];

        // Revisar cada técnico para ver si tiene disponibilidad
        foreach ($tecnicos as $tecnico) {
            // Obtener las inspecciones del técnico en esa fecha
            $inspeccionesTecnico = $inspecciones->where('idTec', $tecnico->idTec);
            // dd($inspeccionesTecnico,$horaInicio,$horaFin,$tecnicos,$inspecciones);
            // Revisar disponibilidad del técnico
            // $disponible = $this->verificarDisponibilidadTecnico($inspeccionesTecnico, $horaInicio, $horaFin);
            $disponible = $inspeccionesTecnico->isEmpty()?true:false;

            // Si está disponible, agregar a la lista
            if ($disponible) {
                $tecnicosDisponibles[] = $tecnico;
            }
        }
        session(['tecnicosDisponibles' => $tecnicosDisponibles]);
        // dd($tecnicosDisponibles);
        // Devolver la lista de técnicos disponibles
        return response()->json(['data' => $tecnicosDisponibles]);
    }
    public function tecnicosDisponibles(Request $r)
    {
        $tecnicos = DB::table('tecnical')->where('disponibilidadDia','1')->get();
        $inspecciones = DB::table('inspections')
            ->where('dateIns', $r->dateIns)
            ->get();
        $tecnicosDisponibles = [];
        // Revisar cada técnico para ver si tiene disponibilidad
        foreach ($tecnicos as $tecnico) {
            // Obtener las inspecciones del técnico en esa fecha
            $inspeccionesTecnico = $inspecciones->where('idTec', $tecnico->idTec);
            // Revisar disponibilidad del técnico
            $disponible = $inspeccionesTecnico->isEmpty()?true:false;
            // Si está disponible, agregar a la lista
            if ($disponible)
                $tecnicosDisponibles[] = $tecnico;
        }
        session(['tecnicosDisponibles' => $tecnicosDisponibles]);
        return response()->json(['data' => $tecnicosDisponibles]);
    }
    public function obtenerInspecciones(Request $r)
    {
        $mesSeleccionado = $r->mes; // Formato 'YYYY-MM'

        // Validar el formato del mes
        if (!preg_match('/^\d{4}-\d{2}$/', $mesSeleccionado)) {
            return response()->json(['error' => 'Formato de mes inválido'], 400);
        }

        [$anioSeleccionado, $mesSeleccionado] = explode('-', $mesSeleccionado); // Dividir 'YYYY-MM' en año y mes

        // Obtener las inspecciones filtradas por el mes y el año seleccionados
        $inspections = DB::table('inspections')
            ->join('tecnical', 'inspections.idTec', '=', 'tecnical.idTec')
            ->select(
                'inspections.idIns as id',
                'tecnical.name as title', // Mostrar el nombre del técnico como título del evento
                'inspections.dateIns as date',
                'inspections.startTime as start',
                'inspections.endTime as end',
                'inspections.idTec'
            )
            ->whereMonth('inspections.dateIns', $mesSeleccionado)
            ->whereYear('inspections.dateIns', $anioSeleccionado)
            ->get();

        // Transformar los datos para que FullCalendar los interprete
        $eventosProgramados = $inspections->map(function ($inspeccion) {
            return [
                'id' => $inspeccion->id,
                'title' => 'Tec#' . $inspeccion->idTec . ' ' . $inspeccion->title,
                'start' => "{$inspeccion->date}T{$inspeccion->start}",
                'end' => "{$inspeccion->date}T{$inspeccion->end}",
            ];
        });
// dd($anioSeleccionado, $mesSeleccionado,$inspections,$eventosProgramados);
        return response()->json(['data' => $eventosProgramados]);
    }

    public function obtenerInspecciones_last(Request $r)
    {
        $mesSeleccionado = $r->mes;
        // Obtener las inspecciones de la base de datos
        $inspections = DB::table('inspections')
            ->join('tecnical', 'inspections.idTec', '=', 'tecnical.idTec')
            ->select(
                'inspections.idIns as id',
                'tecnical.name as title', // Mostrar el nombre del técnico como título del evento
                'inspections.dateIns as date',
                'inspections.startTime as start',
                'inspections.endTime as end',
                'inspections.idTec'
            )
            ->get();

        // Transformar los datos para que FullCalendar los interprete
        $eventosProgramados = $inspections->map(function ($inspeccion) {
            return [
                'id' => $inspeccion->id,
                'title' => 'Tec#' . $inspeccion->idTec . ' ' . $inspeccion->title,
                'start' => "{$inspeccion->date}T{$inspeccion->start}",
                'end' => "{$inspeccion->date}T{$inspeccion->end}",
            ];
        });

        return response()->json(['data' => $eventosProgramados]);
    }
    public function obtenerInspecciones_libres_mas()
    {
        $inspections = DB::table('inspections')->get();
        $workStart = '08:00:00';
        $workEnd = '17:00:00';
        $lunchStart = '12:00:00';
        $lunchEnd = '14:00:00';

        $intervalosLibres = [];

        // Agrupar por fecha y técnico
        $inspectionsGrouped = $inspections->groupBy(['dateIns', 'idTec']);

        foreach ($inspectionsGrouped as $date => $technicians) {
            foreach ($technicians as $idTec => $inspections) {
                $intervalos = [];

                // Ordenar las inspecciones por hora de inicio
                $sortedInspections = $inspections->sortBy('startTime');

                $previousEnd = $workStart; // Inicio del horario laboral

                foreach ($sortedInspections as $inspection) {
                    // Agregar intervalo libre entre la inspección anterior y la actual
                    if ($inspection->startTime > $previousEnd) {
                        $intervalos[] = [
                            'start' => max($previousEnd, $lunchEnd), // Considera el fin del almuerzo
                            'end' => min($inspection->startTime, $lunchStart), // Considera el inicio del almuerzo
                        ];
                    }
                    $previousEnd = max($inspection->endTime, $lunchEnd);
                }

                // Agregar intervalo libre después de la última inspección
                if ($previousEnd < $workEnd) {
                    $intervalos[] = [
                        'start' => max($previousEnd, $lunchEnd),
                        'end' => $workEnd,
                    ];
                }

                // Agregar los intervalos al resultado
                foreach ($intervalos as $intervalo) {
                    if ($intervalo['start'] < $intervalo['end']) { // Validar intervalo válido
                        $intervalosLibres[] = [
                            'title' => 'Libre',
                            'start' => "$date {$intervalo['start']}",
                            'end' => "$date {$intervalo['end']}",
                            'color' => '#f4f4f4', // Color de intervalos libres
                        ];
                    }
                }
            }
        }

        // Convertir las inspecciones a eventos
        $inspectionsEvents = $inspections->map(function ($inspection) {
            return [
                'title' => 'Inspección',
                'start' => "{$inspection->dateIns} {$inspection->startTime}",
                'end' => "{$inspection->dateIns} {$inspection->endTime}",
                'color' => '#378006',
            ];
        });

        // Combinar eventos
        $events = $inspectionsEvents->merge($intervalosLibres);

        return response()->json($events);
    }
    public function obtenerHorariosDisponiblesPorMes(Request $r)
    {
        // Verificar que se reciba un mes válido en el formato 'YYYY-MM'
        $mesSeleccionado = $r->mes; // Formato esperado: 'YYYY-MM'
        // $mesSeleccionado='2024-12';
        // dd($mesSeleccionado);
        if (!$mesSeleccionado) {
            return response()->json(['error' => 'Mes no especificado.'], 400);
        }

        // Obtener el rango del mes
        $primerDiaMes = Carbon::parse("{$mesSeleccionado}-01");
        $ultimoDiaMes = $primerDiaMes->copy()->endOfMonth();

        // Definir horarios laborales y de almuerzo
        $horaInicioDia = Carbon::parse('08:00');
        $horaFinDia = Carbon::parse('17:00');
        $horaInicioAlmuerzo = Carbon::parse('12:00');
        $horaFinAlmuerzo = Carbon::parse('14:00');
        $duracionMinima = 60;

        // Obtener técnicos
        $listTecnical = DB::table('tecnical')->get();

        // Obtener solo las fechas que tienen inspecciones
        $fechasConInspecciones = DB::table('inspections')
            ->whereBetween('dateIns', [$primerDiaMes->format('Y-m-d'), $ultimoDiaMes->format('Y-m-d')])
            ->distinct()
            ->pluck('dateIns');

        // Obtener inspecciones del mes
        $horariosOcupados = DB::table('inspections')
            ->whereIn('dateIns', $fechasConInspecciones)
            ->orderBy('dateIns')
            ->orderBy('startTime')
            ->get();

        $horariosDisponiblesPorDia = [];

        // Procesar solo las fechas que tienen inspecciones
        foreach ($fechasConInspecciones as $fecha) {
            foreach ($listTecnical as $tecnico) {
                $inspeccionesTecnico = $horariosOcupados->where('idTec', $tecnico->idTec)->where('dateIns', $fecha);
                $horaLibreInicio = $horaInicioDia;

                foreach ($inspeccionesTecnico as $horario) {
                    $horaOcupadaInicio = Carbon::parse($horario->startTime);
                    $horaOcupadaFin = Carbon::parse($horario->endTime);

                    // Excluir la hora de almuerzo
                    if ($horaLibreInicio->between($horaInicioAlmuerzo, $horaFinAlmuerzo)) {
                        $horaLibreInicio = $horaFinAlmuerzo;
                    }

                    // Verificar si hay un intervalo disponible
                    if ($horaLibreInicio->diffInMinutes($horaOcupadaInicio) >= $duracionMinima) {
                        $horariosDisponiblesPorDia[] = [
                            'tecnico' => "Tec#{$tecnico->idTec}: {$tecnico->name}",
                            'date' => $fecha,
                            'hora_inicio' => $horaLibreInicio->format('H:i'),
                            'hora_fin' => $horaOcupadaInicio->format('H:i'),
                        ];
                    }

                    // Actualizar el inicio del próximo horario libre
                    $horaLibreInicio = $horaOcupadaFin;
                }

                // Considerar el último intervalo del día
                if ($horaLibreInicio->between($horaInicioAlmuerzo, $horaFinAlmuerzo)) {
                    $horaLibreInicio = $horaFinAlmuerzo;
                }
                if ($horaLibreInicio->diffInMinutes($horaFinDia) >= $duracionMinima) {
                    $horariosDisponiblesPorDia[] = [
                        'tecnico' => "Tec#{$tecnico->idTec}: {$tecnico->name}",
                        'date' => $fecha,
                        'hora_inicio' => $horaLibreInicio->format('H:i'),
                        'hora_fin' => $horaFinDia->format('H:i'),
                    ];
                }
            }
        }

        return response()->json(['data' => $horariosDisponiblesPorDia]);
    }

    public function obtenerHorariosDisponiblesPorMes_cvr(Request $r)
    {
        // Verificar que se reciba un mes válido en el formato 'YYYY-MM'
        $mesSeleccionado = $r->mes; // Formato esperado: 'YYYY-MM'
        $mesSeleccionado='2024-12';
        if (!$mesSeleccionado) {
            return response()->json(['error' => 'Mes no especificado.'], 400);
        }

        // Obtener el primer y último día del mes
        $primerDiaMes = Carbon::parse("{$mesSeleccionado}-01");
        $ultimoDiaMes = $primerDiaMes->copy()->endOfMonth();

        // Definir horarios laborales y de almuerzo
        $horaInicioDia = Carbon::parse('08:00');
        $horaFinDia = Carbon::parse('17:00');
        $horaInicioAlmuerzo = Carbon::parse('12:00');
        $horaFinAlmuerzo = Carbon::parse('14:00');
        $duracionMinima = 60;

        // Obtener técnicos y horarios ocupados para el mes completo
        $listTecnical = DB::table('tecnical')->get();
        $horariosOcupados = DB::table('inspections')
            ->whereBetween('dateIns', [$primerDiaMes->format('Y-m-d'), $ultimoDiaMes->format('Y-m-d')])
            ->orderBy('dateIns')
            ->orderBy('startTime')
            ->get();

        $horariosDisponiblesPorDia = [];

        // Procesar cada día del mes
        foreach (Carbon::parse($primerDiaMes)->daysUntil($ultimoDiaMes) as $fecha) {
            foreach ($listTecnical as $tecnico) {
                $inspeccionesTecnico = $horariosOcupados->where('idTec', $tecnico->idTec)->where('dateIns', $fecha->format('Y-m-d'));
                $horaLibreInicio = $horaInicioDia;

                foreach ($inspeccionesTecnico as $horario) {
                    $horaOcupadaInicio = Carbon::parse($horario->startTime);
                    $horaOcupadaFin = Carbon::parse($horario->endTime);

                    // Excluir la hora de almuerzo
                    if ($horaLibreInicio->between($horaInicioAlmuerzo, $horaFinAlmuerzo)) {
                        $horaLibreInicio = $horaFinAlmuerzo;
                    }

                    // Verificar si hay un intervalo disponible
                    if ($horaLibreInicio->diffInMinutes($horaOcupadaInicio) >= $duracionMinima) {
                        $horariosDisponiblesPorDia[] = [
                            'tecnico' => "Técnico #{$tecnico->idTec}: {$tecnico->name}",
                            'date' => $fecha->format('Y-m-d'),
                            'hora_inicio' => $horaLibreInicio->format('H:i'),
                            'hora_fin' => $horaOcupadaInicio->format('H:i'),
                        ];
                    }

                    // Actualizar el inicio del próximo horario libre
                    $horaLibreInicio = $horaOcupadaFin;
                }

                // Considerar el último intervalo del día
                if ($horaLibreInicio->between($horaInicioAlmuerzo, $horaFinAlmuerzo)) {
                    $horaLibreInicio = $horaFinAlmuerzo;
                }
                if ($horaLibreInicio->diffInMinutes($horaFinDia) >= $duracionMinima) {
                    $horariosDisponiblesPorDia[] = [
                        'tecnico' => "Técnico #{$tecnico->idTec}: {$tecnico->name}",
                        'date' => $fecha->format('Y-m-d'),
                        'hora_inicio' => $horaLibreInicio->format('H:i'),
                        'hora_fin' => $horaFinDia->format('H:i'),
                    ];
                }
            }
        }

        return response()->json(['data' => $horariosDisponiblesPorDia]);
    }

    public function obtenerHorariosDisponiblesPorMes_fgdb(Request $request)
    {
        // $mes = $request->mes; // El formato debe ser 'YYYY-MM', por ejemplo, '2024-12'.
        $mes='2024-12';
        // Verificar si el mes está presente
        if (!$mes)
            return response()->json(['error' => 'El parámetro "mes" es obligatorio'], 400);
        // Obtener horarios ocupados para el mes solicitado
        $horariosOcupados = DB::table('inspections')
            ->where('dateIns', 'like', "$mes%")
            ->orderBy('dateIns')
            ->orderBy('startTime')
            ->get();
        // Definir horarios de inicio y fin del día laboral
        $horaInicioDia = Carbon::parse('08:00');
        $horaFinDia = Carbon::parse('17:00');
        $duracionMinima = 60; // Duración mínima en minutos

        // Definir el rango de la hora de almuerzo (12:00 pm a 2:00 pm)
        $horaInicioAlmuerzo = Carbon::parse('12:00');
        $horaFinAlmuerzo = Carbon::parse('14:00');

        $horariosDisponibles = [];
        $listTecnical = DB::table('tecnical')->get();

        foreach ($listTecnical as $tecnico)
        {
            $inspeccionesTecnico = $horariosOcupados->where('idTec', $tecnico->idTec);
            $horaLibreInicio = $horaInicioDia;

            foreach ($inspeccionesTecnico as $horario)
            {
                $horaOcupadaInicio = Carbon::parse($horario->startTime);
                $horaOcupadaFin = Carbon::parse($horario->endTime);

                // Excluir la hora de almuerzo
                if ($horaLibreInicio->between($horaInicioAlmuerzo, $horaFinAlmuerzo))
                    $horaLibreInicio = $horaFinAlmuerzo;

                // Verificar si hay un intervalo libre antes del horario ocupado
                if ($horaLibreInicio->diffInMinutes($horaOcupadaInicio) >= $duracionMinima) {
                    $horariosDisponibles[] = [
                        'date' => $horario->dateIns,
                        'tecnico' => 'Tecnico #'.$tecnico->idTec.': '.$tecnico->name,
                        'hora_inicio' => $horaLibreInicio->format('H:i'),
                        'hora_fin' => $horaOcupadaInicio->format('H:i')
                    ];
                }
                // Actualizar el inicio del próximo horario libre
                $horaLibreInicio = $horaOcupadaFin;
            }
            // Verificar el último intervalo libre hasta el fin del día
            if ($horaLibreInicio->between($horaInicioAlmuerzo, $horaFinAlmuerzo)) {
                $horaLibreInicio = $horaFinAlmuerzo;
            }
            if ($horaLibreInicio->diffInMinutes($horaFinDia) >= $duracionMinima) {
                $horariosDisponibles[] = [
                    'date' => $horario->dateIns ?? $mes, // Si no hay inspección, usar el mes como referencia
                    'tecnico' => $tecnico->name,
                    'hora_inicio' => $horaLibreInicio->format('H:i'),
                    'hora_fin' => $horaFinDia->format('H:i')
                ];
            }
        }

        return response()->json(['data' => $horariosDisponibles]);
    }
    public function actSaveChangeIns(Request $request)
    {
        // Validar los datos recibidos
        $validated = $request->validate([
            'fechaIns' => 'required|date',
            'hoursAvailable' => 'required|string',
            'hourInsInicio' => 'required|date_format:H:i',
            'hourInsFin' => 'required|date_format:H:i|after:hourInsInicio',
        ]);

        // Separar el ID del técnico y el intervalo de tiempo
        $hoursAvailable = $request->hoursAvailable;
        [$idTec, $timeRange] = explode('-', $hoursAvailable, 2);
        [$intervalStart, $intervalEnd] = explode('-', $timeRange);

        // Validar que las horas de inicio y fin estén dentro del intervalo
        if ($request->hourInsInicio < $intervalStart || $request->hourInsInicio > $intervalEnd) {
            return response()->json([
                'state' => false,
                'message' => 'La hora de inicio está fuera del intervalo permitido.',
            ], 422);
        }

        if ($request->hourInsFin < $intervalStart || $request->hourInsFin > $intervalEnd) {
            return response()->json([
                'state' => false,
                'message' => 'La hora de finalización está fuera del intervalo permitido.',
            ], 422);
        }

        // Guardar en la base de datos
        try {
            $idFo2 = TFormat2::where('codRec',$request->codRec)->first()->idFo2;
            // DB::table('inspections')->insert([
            //     'idTec' => $idTec,
            //     'dateIns' => $request->fechaIns,
            //     'startTime' => $request->hourInsInicio,
            //     'endTime' => $request->hourInsFin,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ]);
            DB::table('inspections')
                ->where('idFo2', $idFo2)
                ->update([
                    'idTec' => $idTec,
                    'dateIns' => $request->fechaIns,
                    'startTime' => $request->hourInsInicio,
                    'endTime' => $request->hourInsFin,
                    // 'updated_at' => now(),
                ]);

            return response()->json([
                'state' => true,
                'message' => 'Inspección guardada correctamente.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'state' => false,
                'message' => 'Error al guardar la inspección: ' . $e->getMessage(),
            ], 500);
        }
    }



}
