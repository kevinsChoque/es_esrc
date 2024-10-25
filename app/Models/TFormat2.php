<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TFormat2 extends Model
{
    protected $table='format2';
	protected $primaryKey='idFo2';
	public $incrementing=true;
	public $timestamps=false;

    protected $fillable = [
        'idFo2',
        'pnumIns',
        'pmeses',
        'preferencia',
        'pnotificar',
        'ppdfFile',
        'codRec',
        'numSum',
        'telefono',
        'app',
        'apm',
        'nombres',
        'numIde',
        'razonSocial',
        'upcjb',
        'upn',
        'upmz',
        'uplote',
        'upub',
        'upp',
        'upd',
        'dpcja',
        'dpn',
        'dpmz',
        'dplote',
        'dpub',
        'dpp',
        'dpd',
        'dpcp',
        'dptelefono',
        'dpcorreo',
        'declaracionReclamo',
        'tipoReclamo',
        'descripcion',
        'sucursal',
        'atendido',
        'fundamento',
        'adjunta',
        'cartilla',
        'declaracion',
        'iie',
        'horaiie',
        'reunion',
        'horaReunion',
        'notificacion',
        'datePortal',
        'channel',
        'verify',
        'f5',
        'f6',
        'f2',
        'process',
        'dateReg'
    ];
}

