<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// ---
use setasign\Fpdi\Fpdi;

use Illuminate\Support\Facades\File;
// ---
use Carbon\Carbon;
use DB;

use App\Models\TFormat2;
use App\Models\TIns;


class Format2Controller extends Controller
{
    public function actForm()
    {
        return view('format2/form');
    }
    public function actShow()
    {
        return view('format2/show');
    }
    public function actEdit()
    {
        return view('format2/edit');
    }
    public function actSavePortal(Request $r)
    {
        $conSql = $this->connectionSql();
        $codRecNum = $this->getNumberClaim();
        if($conSql)
        {
            $script = "select * from CONEXION c
            left outer join rzcalle rz ON rz.calcod = c.precalle
            where c.InscriNro='".$r->ins."'";
            $stmt = sqlsrv_query($conSql, $script);
            $reg = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
            if(!$reg)
                return response()->json(['state'=>false,'message'=>"No existe este el usuario con el numero de inscripcion: ".$r->ins]);
        }
        $existReclaim = TFormat2::where('pnumIns',$r->ins)->where('process','1')->exists();
        if($existReclaim)
            return response()->json(['state'=>false,'message'=>"El usuario ya cuenta con un reclamo en proceso."]);
        if($r->hasFile('fileEvidence') && $r->file('fileEvidence')->getClientMimeType() !== 'application/pdf')
            return response()->json(['state' => false, 'message' => 'Ingrese un archivo válido.']);
        if(!$codRecNum)
            return response()->json(['state' => false, 'message' => 'No fue posible obtener codigo de reclamo.']);
        $codRec = Carbon::now()->year.'-'.$codRecNum;
        // $nameFile = Carbon::now()->format('Ymd_His') . '_' . $this->cleanNameFile($r->file('fileEvidence')->getClientOriginalName());
        $nameFile = $codRec.'_evidencias.pdf';
        $pathFile = 'reclamos/'.$codRec;

        $pathFile = $this->saveFile($r, $nameFile, $pathFile);


        DB::beginTransaction();
        try {
            if($pathFile)
            {
                $r->merge([
                    'pnumIns' => $r->ins,
                    'codRec' => $codRec,
                    'numIde' => $r->docIde,
                    'nombres' => $r->nombres,
                    'app' => $r->app,
                    'apm' => $r->apm,
                    'dpcorreo' => $r->correo,
                    'declaracionReclamo' => $r->dro,
                    'dptelefono' => $r->celular,
                    'tipoReclamo' => $r->tipo,
                    'pmeses' => implode(",",$r->meses),
                    'preferencia' => $r->referencia,
                    'pnotificar' => $r->notificar,
                    'ppdfFile' => $pathFile,
                    'fundamento' => $r->fundamento,
                    'declaracion' => $r->dro1,
                    'datePortal' => Carbon::now(),
                    'channel' => 'web',
                    'process' => '1',
                ]);
                // dd($r->all());
                $tf2 = TFormat2::create($r->all());
                if($tf2)
                {
                    // actualizar este numero en docum
                    // $codRec

                    // una vez lo guarda crear el registro en inspections, donde estara el orario de inspeccion
                    $ids = DB::table('tecnical')->get()->pluck('idTec')->toArray();
                    if(is_null($r->hoursAvailable))
                        $idTecnical = $ids[array_rand($ids)];
                    else
                        $idTecnical = explode('-',$r->hoursAvailable)[0];
                    $ins = new TIns();
                    $ins->idFo2 = $tf2->idFo2;
                    $ins->idTec = $idTecnical;
                    $ins->dateIns = $r->fechaIns;
                    $ins->startTime = $r->hourIns;
                    $ins->endTime =  Carbon::createFromFormat('H:i', $r->hourIns)->addHours(env('HOURS_INSPECTION'))->format('H:i');
                    if($ins->save() && $this->updateNumberClaim($codRecNum))
                    {
                        DB::commit();
                        return response()->json(['state' => true, 'message' => 'Reclamo registrado correctamente']);
                    }
                    else
                    {
                        DB::rollBack();
                        return response()->json(['state' => false, 'message' => 'No fue posible registrar la fecha de inspeccion seleccionada.']);
                    }
                }
                else
                {
                    DB::rollBack();
                    return response()->json(['state' => false, 'message' => 'No fue posible registrar el RECLAMO']);
                }
            }
            else
            {
                DB::rollBack();
                return response()->json(['state' => false, 'message' => 'No fue posible registrar la EVIDENCIA']);
            }
        } catch (\Exception $e) {
            // throw new \Exception('No fue posible registrar la evidencia del RECLAMO');
            DB::rollBack();
            return response()->json(['state' => false, 'message' => $e->getMessage()],500);
        }
    }
    public function actSaveClaim(Request $r)
    {
        if($r->according=='true')
            return $this->accordingWeb($r);
        else
            return $this->accordingNew($r);
    }
    private function accordingWeb($r)
    {
        // dd($r->all());
        // guardar archivo combinado
        $fo2 = TFormat2::where('codRec',$r->codRec)->first();
        $rutaArchivoExistente = storage_path('app/public/'.$fo2->ppdfFile);
        $archivoFormulario = $r->file('evidenceFile');
        $pdf = new Fpdi();
        function agregarPaginas($pdf, $rutaArchivo) {
            $totalPaginas = $pdf->setSourceFile($rutaArchivo);
            for ($pagina = 1; $pagina <= $totalPaginas; $pagina++) {
                $tplIdx = $pdf->importPage($pagina);
                $pdf->AddPage();
                $pdf->useTemplate($tplIdx);
            }
        }
        agregarPaginas($pdf, $rutaArchivoExistente);
        agregarPaginas($pdf, $archivoFormulario->path());
            // Guardar el PDF combinado en el almacenamiento de Laravel
        $nombreArchivoCombinado = $r->codRec.'_evidencias.pdf';
        // $directorioArchivoCombinado = 'public/' . $r->codRec;
        $rutaArchivoCombinado = 'public/reclamos/'.$r->codRec.'/' . $nombreArchivoCombinado;

        // Verificar y crear el directorio si no existe
        // if (!Storage::exists($directorioArchivoCombinado)) {
        //     Storage::makeDirectory($directorioArchivoCombinado);
        // }

        // Guarda el PDF combinado en una ruta accesible en storage
        $tempFilePath = storage_path('app/' . $rutaArchivoCombinado);
        $pdf->Output($tempFilePath, 'F');

        if (!file_exists($tempFilePath))
            return response()->json(['state' => false, 'message' => 'No fue posible guardar el archivo combinado.']);


        $fo2 = TFormat2::where('codRec', $r->codRec)->first();
        $r->merge([
            'codRec' => $r->codRec,
            'numSum' => $r->suministro,
            'nombres' => $r->nombres,
            'app' => $r->app,
            'apm' => $r->apm,
            'numIde' => $r->numIde,
            'upcjb' => $r->upcjb,
            'upn' => $r->upn,
            'upmz' => $r->upmz,
            'uplote' => $r->uplote,
            'upub' => $r->upub,
            'upp' => $r->upp,
            'upd' => $r->upd,
            'dpcja' => $r->dpcja,
            'dpn' => $r->dpn,
            'dpmz' => $r->dpmz,
            'dplote' => $r->dplote,
            'dpub' => $r->dpub,
            'dpp' => $r->dpp,
            'dpd' => $r->dpd,
            'dpcp' => $r->dpcp,
            'dptelefono' => $r->dptelefono,
            'dpcorreo' => $r->dpcorreo,
            'declaracionReclamo' => $r->sendNotify,
            'tipoReclamo' => $r->tipoReclamo,
            'descripcion' => $r->descripcion,
            'sucursal' => $r->sucursal,
            'atendido' => $r->atendido,
            'fundamento' => $r->fundamento,
            'cartilla' => $r->sendBooklet,
            'declaracion' => $r->sendReclaim,
            'verify' => 1,
            'dateReg' => Carbon::now(),
        ]);
        $fo2->fill($r->all());
        if ($fo2->save())
            return response()->json(['state' => true, 'message' => 'Se actualizó correctamente']);
        return response()->json(['state' => false, 'message' => 'Ocurrió un problema, por favor contáctese con el administrador.']);
    }
    private function accordingNew($r)
    {
        // dd($r->all());

        $conSql = $this->connectionSql();
        if($conSql)
        {
            $values = explode('-', $r->suministro);
            $script = "select * from CONEXION c
            left outer join rzcalle rz ON rz.calcod = c.precalle
            where c.PreMzn='".$values[0]."' and c.PreLote='".$values[1]."'";
            $stmt = sqlsrv_query($conSql, $script);
            $reg = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
            if(!$reg)
                return response()->json(['state'=>false,'message'=>"Ocurrio problemas al buscar el registro. "]);
            $ins = trim($reg['InscriNro']);
            $existReclaim = TFormat2::where('pnumIns',$ins)->where('process','1')->exists();
            if($existReclaim)
                return response()->json(['state'=>false,'message'=>"El usuario ya cuenta con un reclamo en proceso."]);
        }
        // ---

        // ---

        $r->merge([
            'pnumIns' => $ins,
            'codRec' => $r->codRec,
            'numSum' => $r->suministro,
            'nombres' => $r->nombres,
            'app' => $r->app,
            'apm' => $r->apm,
            'numIde' => $r->numIde,
            'razonSocial' => $r->razonSocial,
            'upcjb' => $r->upcjb,
            'upn' => $r->upn,
            'upmz' => $r->upmz,
            'uplote' => $r->uplote,
            'upub' => $r->upub,
            'upp' => $r->upp,
            'upd' => $r->upd,
            'dpcja' => $r->dpcja,
            'dpn' => $r->dpn,
            'dpmz' => $r->dpmz,
            'dplote' => $r->dplote,
            'dpub' => $r->dpub,
            'dpp' => $r->dpp,
            'dpd' => $r->dpd,
            'dpcp' => $r->dpcp,
            'dptelefono' => $r->dptelefono,
            'dpcorreo' => $r->dpcorreo,
            'declaracionReclamo' => $r->sendNotify,
            'pmeses' => implode(",",$r->meses),
            'tipoReclamo' => $r->tipoReclamo,
            'descripcion' => $r->descripcion,
            'sucursal' => $r->sucursal,
            'atendido' => $r->atendido,
            'fundamento' => $r->fundamento,
            'cartilla' => $r->sendBooklet,
            'declaracion' => $r->sendReclaim,
            'channel' => 'new',
            'verify' => 1,
            'dateReg' => Carbon::now(),
        ]);
        $tf2 = TFormat2::create($r->all());
        if($tf2)
        {
            $codRec = explode('-',$r->codRec)[1];
            if($this->updateNumberClaim($codRec))
            {
                if ($r->hasFile('evidenceFile'))
                {
                    if ($r->file('evidenceFile')->getClientMimeType() !== 'application/pdf')
                        return response()->json(['state' => false, 'message' => 'Se guardo el reclamo pero la evidencia no es un archivo valido.']);
                    $nameFile = $r->codRec . '_' . 'evidencias.'.$r->file('evidenceFile')->getClientOriginalExtension();
                    $pathFile = $this->saveFileReg($r, 'evidenceFile', $nameFile, $r->codRec);
                    if ($pathFile)
                    {
                        if($tf2->update(['ppdfFile' => $pathFile]))
                            return response()->json(['state' => true, 'message' => 'Reclamo registrado correctamente']);
                        else
                            return response()->json(['state' => false, 'message' => 'Se guardo correctamente, pero no pudo guardar la ruta del archivo.']);
                    }
                    else
                        return response()->json(['state' => false, 'message' => 'No fue posible guardar el archivo de la evidencia.']);
                }
                return response()->json(['state' => true, 'message' => 'Reclamo registrado correctamente']);
            }
            else
                return response()->json(['state' => false, 'message' => 'No fue posible actualizar el numero de reclamo.']);
        }
        return response()->json(['state' => false, 'message' => 'Ocurrió un problema, por favor contáctese con el administrador.']);
    }
    public function actSearchReclaim(Request $r)
    {
        $conSql = $this->connectionSql();
        if($conSql)
        {
            $fo2 = TFormat2::where('pnumIns',$r->dataSearch)->first();
            $ins = TIns::where('idFo2',$fo2->idFo2)->first();

            // $script = "select * from CONEXION where InscriNro='".$r->dataSearch."'";
            $script = "select * from CONEXION c
            left outer join rzcalle rz ON rz.calcod = c.precalle
            where c.InscriNro='".$r->dataSearch."'";
            $stmt = sqlsrv_query($conSql, $script);
            $reg = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);

            return response()->json(['state' => true, "data"=>$reg, 'fo2' => $fo2, 'ins' => $ins]);
        }
        return response()->json(['state' => false, 'message' => 'Ocurrio un problema, por favor contactese con el administrador.']);
    }
    public function actSearchData(Request $r)
    {
        // dd($r->all());
        $conSql = $this->connectionSql();
        if($conSql)
        {
            if(!is_null($r->inscription))
            {
                $codRec = Carbon::now()->year.'-'.$this->getNumberClaim();
                $script = "select * from CONEXION c
                left outer join rzcalle rz ON rz.calcod = c.precalle
                where c.InscriNro='".$r->inscription."'";
                $stmt = sqlsrv_query($conSql, $script);
                $reg = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
                if(is_null($reg)) return response()->json(['state' => false, 'message' => 'No se encontro la CONEXION']);
                return response()->json(['state' => true, "data"=>$reg, 'codRec' => $codRec, 'message' => "Se realizo la busqueda por numero de Inscripcion."]);
            }
            if(!is_null($r->preMzn) && !is_null($r->preLote))
            {
                $codRec = Carbon::now()->year.'-'.$this->getNumberClaim();
                $script = "select * from CONEXION c
                left outer join rzcalle rz ON rz.calcod = c.precalle
                where c.preMzn='".$r->preMzn."' and c.preLote='".$r->preLote."'";
                $stmt = sqlsrv_query($conSql, $script);
                $reg = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
                if(is_null($reg)) return response()->json(['state' => false, 'message' => 'No se encontro la CONEXION']);
                return response()->json(['state' => true, "data"=>$reg, 'codRec' => $codRec, 'message' => "Se realizo la busqueda por Codigo Catastral."]);
            }
            return response()->json(['state' => false, 'message' => 'Ocurrio un problema, por favor contactese con el administrador.']);
        }
        return response()->json(['state' => false, 'message' => 'Ocurrio un problema, por favor contactese con el administrador.']);
    }
    public function actSearchName(Request $r)
    {
        $conSql = $this->connectionSql();
        if ($conSql && !is_null($r->name))
        {
            $codRec = Carbon::now()->year . '-' . $this->getNumberClaim();
            $script = "SELECT * FROM CONEXION c
                    LEFT OUTER JOIN rzcalle rz ON rz.calcod = c.precalle
                    WHERE c.Clinomx LIKE ?";
            $params = ['%' . $r->name . '%'];
            $stmt = sqlsrv_query($conSql, $script, $params);
            if ($stmt === false)
                return response()->json(['state' => false, 'message' => 'Error en la consulta de la informacion.']);
            $results = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
            {   $results[] = $row;}
            if (empty($results))
                return response()->json(['state' => false, 'message' => 'No se encontraron registros para la búsqueda.']);
            return response()->json([
                'state' => true,
                'data' => $results,
                'codRec' => $codRec,
                'message' => 'Se realizó la búsqueda por nombre.'
            ]);
        }
        return response()->json(['state' => false, 'message' => 'Ocurrió un problema, por favor contáctese con el administrador.']);
    }
    public function actSearchIns(Request $r)
    {
        $conSql = $this->connectionSql();
        if($conSql)
        {
            if(!is_null($r->ins))
            {
                $codRec = Carbon::now()->year.'-'.$this->getNumberClaim();
                $script = "select * from CONEXION c
                left outer join rzcalle rz ON rz.calcod = c.precalle
                where c.InscriNro='".$r->ins."'";
                $stmt = sqlsrv_query($conSql, $script);
                $reg = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
                if(is_null($reg)) return response()->json(['state' => false, 'message' => 'No se encontro el Registro del usuario.']);
                return response()->json(['state' => true, "data"=>$reg, 'codRec' => $codRec, 'message' => "Se realizo la busqueda por numero de Inscripcion."]);
            }
        }
        return response()->json(['state' => false, 'message' => 'Ocurrio un problema, por favor contactese con el administrador.']);
    }
    public function actSearchInscription(Request $r)
    {
        dd($r->all());
        $conSql = $this->connectionSql();
        if ($conSql)
        {
            $script = "select * from INSCRIPC where InscriNro='".$r->inscription."'";
            $script = "select CAST(c.PreMzn AS VARCHAR) + '-' + CAST(c.PreLote AS VARCHAR) AS suministro,c.PreMzn as preMzn, c.PreLote as preLote,i.* from CONEXION c
            left outer join INSCRIPC i ON i.InscriNro=c.InscriNro
            left outer join rzcalle rz ON rz.calcod = c.precalle
            where c.InscriNro='".$r->inscription."'";

            $stmt = sqlsrv_query($conSql, $script);
            $reg = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
            return response()->json(['estado' => true,"data"=>$reg]);
        }
        else
        {
            dd('No se pudo establecer la conexión');
        }
    }
    public function actList()
    {
        // $list = TFormat2::all();
        $list = TFormat2::join('inspections', 'inspections.idFo2', '=', 'format2.idFo2')
            ->select('format2.*', 'inspections.*')
            ->get();

        return response()->json(['data' => $list]);
    }
    public function actFillReclaimWeb()
    {
        $list = TFormat2::where('channel','web')
            ->where(function($query){
                $query->whereNull('verify')
                ->orWhere('verify', 0);
            })->orderBy('codRec', 'desc')->get();
        return response()->json(['state'=>true,'data'=>$list]);
    }

    // public function actShowEvidence(Request $r)
    public function actShowEvidence($idFo2)
    {
        // dd($r->all());
        // $rec = TFormat2::find($r->idFo2);
        // if ($rec && $rec->ppdfFile) {
        //     // Obtener la URL pública del archivo
        //     $url = Storage::url($rec->ppdfFile);
        //     return response()->json(['state'=>false, 'url' => $url]);
        // }
        // return response()->json(['state'=>false,'message'=>'No se encontro el archivo']);
        $rec = TFormat2::find($idFo2);
// dd('entro');
        // $tPro = Session::get('proveedor');
    	// $cadena = explode("_", $nombreArchivo);
    	// $tCrp = TCotrecpro::find($cadena[0]);
        $rutaArchivo = storage_path('app/public/'.$rec->ppdfFile);
        // dd($rutaArchivo);
        if (file_exists($rutaArchivo))
            return response()->file($rutaArchivo);
        else
            abort(404);
    }



}
