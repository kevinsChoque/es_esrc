<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use Carbon\Carbon;
use DB;
use App\Models\TFormat2;
use App\Models\TProcess;
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
    public static function combinePDFs(array $files, $pathFile,$nameFile)
    {
        try {
            $pdf = new Fpdi();
            foreach ($files as $file)
            {
                if (!$file->isValid() || $file->getClientOriginalExtension() !== 'pdf')
                    throw new \Exception("Uno de los archivos no es un PDF válido.");
                $filePath = $file->getPathname();
                $pageCount = $pdf->setSourceFile($filePath);
                for ($i = 1; $i <= $pageCount; $i++)
                {
                    $templateId = $pdf->importPage($i);
                    $size = $pdf->getTemplateSize($templateId);
                    // Crear una nueva página con las dimensiones del PDF original
                    $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
                    $pdf->useTemplate($templateId);
                }
            }
            $directoryPath = storage_path('app/public/' . $pathFile);
            if (!file_exists($directoryPath))
                mkdir($directoryPath, 0777, true);
            $outputPath = $directoryPath . '/' . $nameFile;
            $pdf->Output('F', $outputPath);
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function actSavePortal(Request $r)
    {
        // dd($r->all());
        if (!$this->validateUserRegistration($r))
            return response()->json(['state' => false, 'message' => 'Usuario no válido o reclamo en proceso.']);
        if (!$this->validateUploadedFiles($r))
            return response()->json(['state' => false, 'message' => 'Archivos no válidos.']);
        $codRecNum = $this->getNumberClaim();
        if(!$codRecNum)
            return response()->json(['state' => false, 'message' => 'No fue posible obtener codigo de reclamo.']);
        $files = array_filter([
            $r->file('fileDocPer'),
            $r->file('fileCarPod'),
            $r->file('fileEvidence'),
        ], function ($file) {
            return $file && $file->isValid();
        });
        $codRec = Carbon::now()->year.'-'.$codRecNum;
        $nameFile = $codRec.'_evidencias.pdf';
        $pathFile = 'reclamos/'.$codRec;
        // dd($files,$pathFile,$nameFile);
        if(!$this->combinePDFs($files,$pathFile,$nameFile))
            return response()->json(['state' => false, 'message' => 'No fue posible guardar los archivos.']);
        $pathFile .= '/' . $nameFile;
        // $pathFile = $this->saveFile($r, $nameFile, $pathFile);
        DB::beginTransaction();
        try {
            $idFo2 = $this->saveClaim($r, $codRec, $pathFile);
            $this->scheduleInspection($r, $idFo2, $codRecNum);
            if (!$this->updateNumberClaim($codRecNum))
                throw new \Exception('No posible actualizar el NUMERO DE RECLAMO.');
            DB::commit();
            return response()->json(['state' => true, 'message' => 'Reclamo registrado correctamente.']);
        } catch (\Exception $e) {
            // throw new \Exception('No fue posible registrar la evidencia del RECLAMO');
            DB::rollBack();
            Log::error('Error en actSavePortal: ' . $e->getMessage());
            return response()->json(['state' => false, 'message' => $e->getMessage()],500);
        }
    }

    private function validateUserRegistration(Request $r): bool
    {
        $conSql = $this->connectionSql();
        $existReclaim = TFormat2::where('pnumIns', $r->ins)->where('process', '<', '9')->exists();
        if ($conSql)
        {
            $stmt = sqlsrv_query($conSql, "SELECT * FROM CONEXION WHERE InscriNro = ?", [$r->ins]);
            $reg = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            if (!$reg || $existReclaim)
                return false;
        }
        return true;
    }
    private function validateUploadedFiles(Request $r): bool
    {
        $fileValidations = $r->validateCarPod == 'true'
        ?[['file' => 'fileDocPer'],['file' => 'fileCarPod'],['file' => 'fileEvidence']]
        :[['file' => 'fileDocPer'],['file' => 'fileEvidence']];
        foreach ($fileValidations as $validation)
        {
            if (!$r->hasFile($validation['file']) || $r->file($validation['file'])->getClientMimeType() !== 'application/pdf')
                return false;
        }
        return true;
    }
    private function saveClaim(Request $r, string $codRec, string $pathFile)
    {
        try
        {
            $claimData = array_merge($r->all(), [
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
                'reunion' => $r->fechaReu,
                'horaReunion' => $r->hoursAvailableReu,
                'datePortal' => Carbon::now(),
                'channel' => 'web',
                'process' => '1',
            ]);
            $claim = TFormat2::create($claimData);
            return $claim->idFo2;
        }
        catch (\Exception $e)
        {
            // Registramos el error para propósitos de depuración
            Log::error("Error al guardar el reclamo: " . $e->getMessage());
            throw new \Exception("No fue posible registrar el reclamo.");
        }

        // if (!$claim)
        //     throw new \Exception('No fue posible registrar el reclamo.');
    }

    private function scheduleInspection(Request $request, string $idFo2,string $codRecNum)
    {
        // $ids = DB::table('tecnical')->pluck('idTec')->toArray();

        $ids = array_map(function ($tecnico) {
            return $tecnico->idTec; // Cambia 'idTec' por el nombre real del campo de ID si es diferente
        },session('tecnicosDisponibles'));
        // dd(gettype($request->tecnicosDisponibles));

        $selectedTechnician = $request->tecnicosDisponibles=='true'
            ? $ids[array_rand($ids)]
            : explode('-', $request->hoursAvailable)[0];
        // dd('llego aki');
        $hoursAvailable = $request->tecnicosDisponibles=='true'
            ? $request->hoursAvailable
            : explode('-', $request->hoursAvailable, 2)[1];
        $inspection = new TIns([
            'idFo2' => $idFo2,
            'idTec' => $selectedTechnician,
            'dateIns' => $request->fechaIns,
            'horario' => $hoursAvailable,
            // 'startTime' => $request->hourIns,
            // 'endTime' => Carbon::createFromFormat('H:i', $request->hourIns)->addHours(env('HOURS_INSPECTION'))->format('H:i'),
        ]);
        // dd($inspection);
        if (!$inspection->save() || !$this->updateNumberClaim($codRecNum)) {
            throw new \Exception('No fue posible programar la inspección técnica.');
        }
        // dd('llego aki');
    }
    public function actSaveClaim(Request $r)
    {
        if($r->according=='true')
            return $this->accordingWeb($r);
        else
            return $this->accordingNew($r);
    }
    private function accordingWeb_last($r)
    {
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
            // 'codRec' => $r->codRec,
            'numSum' => $r->suministro,
            // 'nombres' => $r->nombres,
            // 'app' => $r->app,
            // 'apm' => $r->apm,
            // 'numIde' => $r->numIde,
            // 'upcjb' => $r->upcjb,
            // 'upn' => $r->upn,
            // 'upmz' => $r->upmz,
            // 'uplote' => $r->uplote,
            // 'upub' => $r->upub,
            // 'upp' => $r->upp,
            // 'upd' => $r->upd,
            // 'dpcja' => $r->dpcja,
            // 'dpn' => $r->dpn,
            // 'dpmz' => $r->dpmz,
            // 'dplote' => $r->dplote,
            // 'dpub' => $r->dpub,
            // 'dpp' => $r->dpp,
            // 'dpd' => $r->dpd,
            // 'dpcp' => $r->dpcp,
            // 'dptelefono' => $r->dptelefono,
            // 'dpcorreo' => $r->dpcorreo,
            'declaracionReclamo' => $r->sendNotify,
            // 'tipoReclamo' => $r->tipoReclamo,
            // 'descripcion' => $r->descripcion,
            // 'sucursal' => $r->sucursal,
            // 'atendido' => $r->atendido,
            // 'fundamento' => $r->fundamento,
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
    private function accordingWeb($r)
    {
        $fo2 = TFormat2::where('codRec', $r->codRec)->first();
        if ($r->hasFile('evidenceFile'))
        {
            $rutaArchivoExistente = storage_path('app/public/' . $fo2->ppdfFile);
            $archivoFormulario = $r->file('evidenceFile');
            $pdf = new Fpdi();
            function agregarPaginas($pdf, $rutaArchivo)
            {
                $totalPaginas = $pdf->setSourceFile($rutaArchivo);
                for ($pagina = 1; $pagina <= $totalPaginas; $pagina++) {
                    $tplIdx = $pdf->importPage($pagina);
                    $pdf->AddPage();
                    $pdf->useTemplate($tplIdx);
                }
            }
            // Agregar páginas del archivo existente (si existe)
            if (file_exists($rutaArchivoExistente))
                agregarPaginas($pdf, $rutaArchivoExistente);
            // Agregar páginas del archivo recibido
            agregarPaginas($pdf, $archivoFormulario->path());
            // Guardar el PDF combinado
            $nombreArchivoCombinado = $r->codRec . '_evidencias.pdf';
            $rutaArchivoCombinado = 'public/reclamos/' . $r->codRec . '/' . $nombreArchivoCombinado;
            // Verificar y crear el directorio si no existe
            $directorioArchivo = storage_path('app/' . dirname($rutaArchivoCombinado));
            if (!file_exists($directorioArchivo)) {
                mkdir($directorioArchivo, 0755, true);
            }
            // Guarda el PDF combinado en el almacenamiento
            $tempFilePath = storage_path('app/' . $rutaArchivoCombinado);
            $pdf->Output($tempFilePath, 'F');
            if (!file_exists($tempFilePath)) {
                return response()->json(['state' => false, 'message' => 'No fue posible guardar el archivo combinado.']);
            }
            // Actualizar la ruta del archivo combinado en el modelo
            $fo2->ppdfFile = str_replace('public/', '', $rutaArchivoCombinado);
        }
        // Rellenar y actualizar los datos del registro
        $r->merge([
            'numSum' => $r->suministro,
            'declaracionReclamo' => $r->sendNotify,
            'cartilla' => $r->sendBooklet,
            'declaracion' => $r->sendReclaim,
            'verify' => 1,
            'dateReg' => Carbon::now(),
        ]);
        $fo2->fill($r->all());
        if ($fo2->save())
        {
            $pro = new TProcess([
                'idFo2' => $fo2->idFo2,
                'codRec' => $fo2->codRec,
                'inscription' => $fo2->pnumIns,
            ]);
            if ($pro->save())
                return response()->json(['state' => true, 'message' => 'Se actualizó correctamente']);
        }
        return response()->json(['state' => false, 'message' => 'Ocurrió un problema, por favor contáctese con el administrador.']);
    }
    private function accordingNew($r)
    {
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
        $r->merge([
            'pnumIns' => $ins,
            'numSum' => $r->suministro,
            'declaracionReclamo' => $r->sendNotify,
            'pmeses' => implode(",",$r->meses),
            'cartilla' => $r->sendBooklet,
            'declaracion' => $r->sendReclaim,
            'channel' => 'new',
            'verify' => 1,
            'process' => 1,
            'dateReg' => Carbon::now(),
        ]);
        $tf2 = TFormat2::create($r->all());
        if($tf2)
        {
            $ids = array_map(function ($tecnico) {
                return $tecnico->idTec;
            },session('tecnicosDisponibles'));
            $selectedTechnician = $r->nhoursAvailable
                ? explode('-', $r->nhoursAvailable)[0]
                : $ids[array_rand($ids)];

            $inspection = new TIns([
                'idFo2' => $tf2->idFo2,
                'idTec' => $selectedTechnician,
                'dateIns' => $r->nfechaIns,
                'startTime' => $r->nhourInsInicio,
                'endTime' => $r->nhourInsFin,
            ]);
            if ($inspection->save())
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
            else
                return response()->json(['state' => false, 'message' => 'No fue posible guardar la fecha de INSPECCION.']);
        }
        return response()->json(['state' => false, 'message' => 'Ocurrió un problema, por favor contáctese con el administrador.']);
    }

    public function actSaveChangeClaim(Request $r)
    {
        DB::beginTransaction(); // Iniciar la transacción
        try {
            $archivo1 = $r->file('evidenceFileReg');
            $archivo2 = $r->file('evidenceFile');
            if($archivo2)
            {
                $rutaArchivoCombinado = null;
                if ($archivo1)
                {
                    $nombreArchivoCombinado = $r->codRec . '_evidencias.pdf';
                    $rutaArchivoCombinado = 'reclamos/' . $r->codRec;
                    $combineSuccess = self::combinePDFs([$archivo1, $archivo2], $rutaArchivoCombinado, $nombreArchivoCombinado);
                    if (!$combineSuccess)
                        throw new \Exception('No fue posible guardar el archivo combinado.');
                }
                else
                    throw new \Exception('Ocurrio un error con el archivo del registro.');
            }
            $fo2 = TFormat2::where('codRec', $r->codRec)->first();
            if (!$fo2)
                throw new \Exception('Registro no encontrado.');
            $r->merge([
                'codRec' => $r->codRec,
                'numSum' => $r->suministro,
                'declaracionReclamo' => $r->sendNotify,
                'cartilla' => $r->sendBooklet,
                'declaracion' => $r->sendReclaim,
                'verify' => 1,
                'dateReg' => Carbon::now(),
            ]);
            $fo2->fill($r->all());
            $fo2->save();
            DB::commit();
            return response()->json(['state' => true, 'message' => 'Se actualizó correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['state' => false, 'message' => $e->getMessage()]);
        }
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
            ->orderBy('format2.codRec','desc')
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
    public function actShowEvidence($idFo2)
    {

        $rec = TFormat2::find($idFo2);
        // dd($rec->ppdfFile);
        $rutaArchivo = storage_path('app/public/'.$rec->ppdfFile);
        if (file_exists($rutaArchivo))
            return response()->file($rutaArchivo);
        else
            abort(404);
    }
    public function actChangeProcess(Request $r)
    {
        $f2 = TFormat2::where('codRec',$r->codRec)->first();
        $f2->process = '2';
        if($f2->save())
            return response()->json(['state'=>true,'message'=>'El reclamo paso a la etapa de inspeccion.']);
        else
            return response()->json(['state'=>false,'message'=>'Error al cambiar el proceso']);
    }
    // public function actLoadClaim_old(Request $r)
    // {
    //     $f2 = TFormat2::where('codRec',$r->codRec)->first();
    //     $ins = TIns::where('idFo2',$f2->idFo2)->first();
    //     if($f2 && $ins)
    //         return response()->json(['state'=>true,'data'=>$f2, 'ins' => $ins]);
    //     else
    //         return response()->json(['state'=>false,'message'=>'Ocurrio un error, porfavor contactese con el administrador.']);
    // }
    public function actLoadClaim(Request $r)
    {
        $f2 = TFormat2::where('codRec', $r->codRec)->first();
        $ins = TIns::where('idFo2', $f2->idFo2)->first();
        $pdfBase64 = null;

        if ($f2 && $f2->ppdfFile && file_exists(storage_path('app/public/' . $f2->ppdfFile))) {
            $pdfPath = storage_path('app/public/' . $f2->ppdfFile);
            $pdfBase64 = base64_encode(file_get_contents($pdfPath));
        }

        if ($f2 && $ins) {
            return response()->json([
                'state' => true,
                'data' => $f2,
                'ins' => $ins,
                'pdf' => $pdfBase64,
            ]);
        } else {
            return response()->json(['state' => false, 'message' => 'Ocurrió un error, por favor contacte al administrador.']);
        }
    }
    public function actFileInspection(Request $r)
    {
        try {
            $pro = TProcess::find($r->idPro);
            if (!$pro)
                return response()->json(['state' => false, 'message' => 'El proceso no fue encontrado.'], 404);
            // $f2 = TFormat2::where('idFo2', $pro->idFo2)->where('pnumIns', $r->ins)->where('process', '<', 9)->first();
            // if (!$f2)
            //     return response()->json(['state' => false, 'message' => 'No se encontró un formato que cumpla las condiciones.'], 404);
            return response()->json(['state' => true, 'data' => $pro]);
        } catch (\Exception $e) {
            return response()->json(['state' => false, 'message' => 'Ocurrió un error inesperado: ' . $e->getMessage()], 500);
        }
    }
    public function actSaveFileIns_las(Request $r)
    {
        // dd($r->all());
        if ($r->hasFile('fileInspection') && $r->file('fileInspection')->getClientMimeType() !== 'application/pdf')
            return response()->json(['state' => false, 'message' => 'Ingrese un archivo válido.']);
        $f2 = TFormat2::find($r->fileidFo2);
        $nameFile = $f2->codRec.'_inspecciones.'.$r->file('fileInspection')->getClientOriginalExtension();
        $pathFile = 'reclamos/'.$f2->codRec;
        dd($f2->idFo2,$nameFile,$pathFile);
        DB::beginTransaction();
        try {
            if (Storage::exists('public/'.$f2->fileIns))
                Storage::delete('public/'.$f2->fileIns);
            $pathFile = $this->saveFileReg($r, 'fileInspection', $nameFile, $pathFile);
            $f2->update(['fileIns' => $pathFile]);
            DB::commit();
            return response()->json(['state' => true, 'message' => 'Se subio el archivo correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['state' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function actSaveFileIns(Request $r)
    {
        try {
            if (!$r->hasFile('fileInspection') || $r->file('fileInspection')->getClientMimeType() !== 'application/pdf')
                return response()->json(['state' => false, 'message' => 'Ingrese un archivo válido en formato PDF.']);
            $pro = TProcess::findOrFail($r->fileidPro);
            // Obtener el registro del formato 2
            $f2 = TFormat2::findOrFail($pro->idFo2); // Usar findOrFail para manejo automático de errores si no se encuentra
            $nameFile = $f2->codRec.'_'.$r->fileidPro.'_inspecciones.'.$r->file('fileInspection')->getClientOriginalExtension();
            $pathFile = 'reclamos/' . $f2->codRec;
            DB::beginTransaction();
            if ($pro->fileIns && Storage::exists('public/' . $pro->fileIns))
                Storage::delete('public/' . $pro->fileIns);
            $newFilePath = $this->saveFileReg($r, 'fileInspection', $nameFile, $pathFile);
            $pro->update(['fileIns' => $newFilePath]);
            DB::commit();
            return response()->json(['state' => true, 'message' => 'Archivo subido correctamente.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['state' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function actShowFileInspection(Request $r,$idPro)
    {
    	$pro = TProcess::find($idPro);
        $pathFile = storage_path('app/public/'.$pro->fileIns);
        if (file_exists($pathFile))
            return response()->file($pathFile);
        else
            abort(404);
    }
    public function actFileRes(Request $r)
    {
        // $f2 = TFormat2::where('idFo2',$r->idFo2)->where('pnumIns',$r->ins)->where('process','<',9)->first();
        // return response()->json(['state' => true, 'data' => $f2]);
        // ----------
        try {
            $pro = TProcess::find($r->idPro);
            if (!$pro)
                return response()->json(['state' => false, 'message' => 'El proceso no fue encontrado.'], 404);
            return response()->json(['state' => true, 'data' => $pro]);
        } catch (\Exception $e) {
            return response()->json(['state' => false, 'message' => 'Ocurrió un error inesperado: ' . $e->getMessage()], 500);
        }
    }
    public function actSaveFileRes(Request $r)
    {
        // dd($r->all());
        try {
            if (!$r->hasFile('resfile') || $r->file('resfile')->getClientMimeType() !== 'application/pdf')
                return response()->json(['state' => false, 'message' => 'Ingrese un archivo válido en formato PDF.']);
            $pro = TProcess::findOrFail($r->residPro);
            $f2 = TFormat2::findOrFail($pro->idFo2); // Usar findOrFail para manejo automático de errores si no se encuentra
            $nameFile = $f2->codRec.'_'.$r->residPro.'_resolucion.'.$r->file('resfile')->getClientOriginalExtension();
            $pathFile = 'reclamos/' . $f2->codRec;
            DB::beginTransaction();
            if ($pro->fileRes && Storage::exists('public/' . $pro->fileRes))
                Storage::delete('public/' . $pro->fileRes);
            $newFilePath = $this->saveFileReg($r, 'resfile', $nameFile, $pathFile);
            $pro->update(['fileRes' => $newFilePath]);
            DB::commit();
            return response()->json(['state' => true, 'message' => 'Archivo subido correctamente.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['state' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function actShowFileRes(Request $r,$idPro)
    {
    	$pro = TProcess::find($idPro);
        $pathFile = storage_path('app/public/'.$pro->fileRes);
        if (file_exists($pathFile))
            return response()->file($pathFile);
        else
            abort(404);
    }
    public function actFileFormat2Full(Request $r)
    {
        try {
            $f2 = TFormat2::find($r->idFo2);
            if (!$f2)
                return response()->json(['state' => false, 'message' => 'El reclamo no fue encontrado.'], 404);
            // $f2 = TFormat2::where('idFo2', $pro->idFo2)->where('pnumIns', $r->ins)->where('process', '<', 9)->first();
            // if (!$f2)
            //     return response()->json(['state' => false, 'message' => 'No se encontró un formato que cumpla las condiciones.'], 404);
            return response()->json(['state' => true, 'data' => $f2]);
        } catch (\Exception $e) {
            return response()->json(['state' => false, 'message' => 'Ocurrió un error inesperado: ' . $e->getMessage()], 500);
        }
    }
    public function actSaveFileFormat2Full(Request $r)
    {
        // dd($r->all());
        try {
            if (!$r->hasFile('fileFormat2Full') || $r->file('fileFormat2Full')->getClientMimeType() !== 'application/pdf')
                return response()->json(['state' => false, 'message' => 'Ingrese un archivo válido en formato PDF.']);
            // $pro = TProcess::findOrFail($r->fileidPro);
            // Obtener el registro del formato 2
            $f2 = TFormat2::findOrFail($r->idFo2); // Usar findOrFail para manejo automático de errores si no se encuentra
            $nameFile = $f2->codRec.'_formato2.'.$r->file('fileFormat2Full')->getClientOriginalExtension();
            $pathFile = 'reclamos/' . $f2->codRec;
            DB::beginTransaction();
            if ($f2->fileFormat2Full && Storage::exists('public/' . $f2->fileFormat2Full))
                Storage::delete('public/' . $f2->fileFormat2Full);
            $newFilePath = $this->saveFileReg($r, 'fileFormat2Full', $nameFile, $pathFile);
            $f2->update(['fileFormat2Full' => $newFilePath]);
            DB::commit();
            return response()->json(['state' => true, 'message' => 'Archivo subido correctamente.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['state' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function actShowFileFormat2Full(Request $r,$idFo2)
    {
    	$f2 = TFormat2::find($idFo2);
        $pathFile = storage_path('app/public/'.$f2->fileFormat2Full);
        if (file_exists($pathFile))
            return response()->file($pathFile);
        else
            abort(404);
    }










}
