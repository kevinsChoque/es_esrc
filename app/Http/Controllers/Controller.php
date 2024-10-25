<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;

use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public $startWork;
    public $endWork;
    protected $arrayDate;

    public function __construct()
    {
        $this->startWork = Carbon::parse('08:00');
        $this->endWork = Carbon::parse('17:00');
        $this->arrayDate = [
            'Enero' => '01-01-',
            'Febrero' => '01-02-',
            'Marzo' => '01-03-',
            'Abril' => '01-04-',
            'Mayo' => '01-05-',
            'Junio' => '01-06-',
            'Julio' => '01-07-',
            'Agosto' => '01-08-',
            'Septiembre' => '01-09-',
            'Octubre' => '01-10-',
            'Noviembre' => '01-11-',
            'Diciembre' => '01-12-'
        ];
    }
    public function cleanNameFile($name){return str_replace(' ', '_', trim($name));}
    public function saveFileReg($r, $input , $nombreArchivo, $directorio)
    {
        try {
            $path = $r->file($input)->storeAs($directorio, $nombreArchivo, 'public');
            return $path;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function saveFile($r, $nombreArchivo, $directorio)
    {
        try {
            $path = $r->file('fileEvidence')->storeAs($directorio, $nombreArchivo, 'public');
            return $path;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function connectionSql()
    {
        $serverName = 'KEVIN-O3VME56';
        $connectionInfo = array("Database"=>"SICEM_AB_k","CharacterSet"=>"UTF-8");
        // $serverName = 'informatica2-pc\sicem_bd';
        // $connectionInfo = array(
        //     "Database" => "SICEM_AB",
        //     "UID" => "comercial",
        //     "PWD" => "1",
        //     "CharacterSet" => "UTF-8"
        // );
        return sqlsrv_connect($serverName, $connectionInfo);
    }
    public function getNumberClaim()
    {
        $conSql = $this->connectionSql();
        if($conSql)
        {
            $script = "select UltNro+1 as number from docum where DocTip='RECLAMO'";
            $stmt = sqlsrv_query($conSql, $script);
            $numberClaim = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
            return $numberClaim['number'];
        }
        return false;
    }
    public function updateNumberClaim($number)
    {
        $conSql = $this->connectionSql();
        if($conSql)
        {
            $script = "update DOCUM set UltNro=".$number." where DocTip='RECLAMO'";
            $stmt = sqlsrv_query($conSql, $script);
            if($stmt === false)return false;
            sqlsrv_close($conSql);
            return true;
        }
        return false;
    }
    function getDatesByMonth($meses)
    {
        // Definir las fechas correspondientes a cada mes
        $year = Carbon::now()->year;
        $fechas = [
            'Enero' => '01-01-'.$year,
            'Febrero' => '01-02-'.$year,
            'Marzo' => '01-03-'.$year,
            'Abril' => '01-04-'.$year,
            'Mayo' => '01-05-'.$year,
            'Junio' => '01-06-'.$year,
            'Julio' => '01-07-'.$year,
            'Agosto' => '01-08-'.$year,
            'Septiembre' => '01-09-'.$year,
            'Octubre' => '01-10-'.$year,
            'Noviembre' => '01-11-'.$year,
            'Diciembre' => '01-12-'.$year
        ];

        // Separar la cadena de meses
        $mesArray = explode(',', $meses);

        // Crear un array para las fechas correspondientes
        // $fechasArray = [];
        $dateString='';

        // Recorrer el array de meses y obtener las fechas correspondientes
        foreach ($mesArray as $mes) {
            $mes = trim($mes); // Eliminar espacios
            if (array_key_exists($mes, $fechas)) {
                // $fechasArray[] = $fechas[$mes];
                $dateString=$dateString."'".$fechas[$mes]."'".',';
            }
        }

        return rtrim($dateString, ',');
    }
    function getMonthBig($moths,$anio)
    {
        $monthsArray = explode(',', $moths);
        $monthsMap = [
            'Enero' => 1,
            'Febrero' => 2,
            'Marzo' => 3,
            'Abril' => 4,
            'Mayo' => 5,
            'Junio' => 6,
            'Julio' => 7,
            'Agosto' => 8,
            'Septiembre' => 9,
            'Octubre' => 10,
            'Noviembre' => 11,
            'Diciembre' => 12
        ];

        // Encontrar el mayor mes en términos numéricos
        $maxMonth = '';
        $maxValue = 0;

        foreach ($monthsArray as $month) {
            $month = trim($month); // Eliminar espacios
            if (isset($monthsMap[$month]) && $monthsMap[$month] > $maxValue) {
                $maxValue = $monthsMap[$month];
                $maxMonth = $month;
            }
        }
        return $this->arrayDate[$maxMonth].$anio;
    }
}
