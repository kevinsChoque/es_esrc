<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $existReclaim = TFormat2::where('pnumIns',$r->ins)->where('process','1')->exists();
        if($existReclaim)
            return response()->json(['state'=>false,'message'=>"El usuario ya cuenta con un reclamo en proceso."]);

        // dd($r->all());
        // dd(gettype(implode(",",$r->meses)));

        // $indiceAleatorio = array_rand($ids);

        // dd($ids[array_rand($ids)],DB::table('tecnical')->get()->pluck('idTec')->toArray(),$r->hoursAvailable,$r->all());

        if($r->hasFile('fileEvidence') && $r->file('fileEvidence')->getClientMimeType() !== 'application/pdf')
            return response()->json(['state' => false, 'message' => 'Ingrese un archivo válido.']);

        $nameFile = Carbon::now()->format('Ymd_His') . '_' . $this->cleanNameFile($r->file('fileEvidence')->getClientOriginalName());
        $pathFile = 'evidencias';

        $pathFile = $this->saveFile($r, $nameFile, $pathFile);

        $codRec = $this->getNumberClaim();
        if(!$codRec)
            return response()->json(['state' => false, 'message' => 'No fue posible obtener codigo de reclamo.']);
        DB::beginTransaction();
        try {
            if($pathFile)
            {
                $r->merge([
                    'pnumIns' => $r->ins,
                    'codRec' => Carbon::now()->year.'-'.$codRec,
                    'numIde' => $r->docIde,
                    'nombres' => $r->nombres,
                    'app' => $r->app,
                    'apm' => $r->apm,
                    'dpcorreo' => $r->correo,
                    'dptelefono' => $r->celular,
                    'tipoReclamo' => $r->tipo,
                    'pmeses' => implode(",",$r->meses),
                    'preferencia' => $r->referencia,
                    'pnotificar' => $r->notificar,
                    'ppdfFile' => $pathFile,
                    'fundamento' => $r->fundamento,
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
                    if($ins->save() && $this->updateNumberClaim($codRec))
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
        // dd($r->all());
        $fo2 = TFormat2::where('codRec',$r->codRec)->first();
        $r->merge([
            'numSum' => $r->suministro,
            'nombres' => $r->nombres,
            'app' => $r->app,
            'apm' => $r->apm,
            'numIde' => $r->numIde,
            'upcjb' => $r->upcjb,
            'dptelefono' => $r->dptelefono,
            'dpcorreo' => $r->dpcorreo,
            'tipoReclamo' => $r->tipoReclamo,
            'descripcion' => $r->descripcion,
            'fundamento' => $r->fundamento,
            'verify' => 1,
            'dateReg' => Carbon::now(),
        ]);
        $fo2->fill($r->all());
        if($fo2->save())
        {
            return response()->json(['state' => true, "message" => 'Se actualizo correctamente']);
        }
        return response()->json(['state' => false, "message" => 'Ocurrio un problema, por favor contactese con el administrador.']);
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
            })->get();
        return response()->json(['state'=>true,'data'=>$list]);
    }


}
