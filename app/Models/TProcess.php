<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TProcess extends Model
{
    protected $table='process';
	protected $primaryKey='idPro';
	public $incrementing=true;
	public $timestamps=false;

    protected $fillable = [
        'idPro',
        'idFo2',
        'codRec',
        'inscription',
        'f5',
        'f6',
        'f7',
        'f4',
        'f8',
        'f9',
        'fileIns',
        'fileRes',
    ];
}


