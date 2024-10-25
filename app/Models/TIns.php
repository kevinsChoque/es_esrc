<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TIns extends Model
{
    protected $table='inspections';
	protected $primaryKey='idIns';
	public $incrementing=false;
	public $timestamps=false;

    protected $fillable = [
        'idIns',
        'idFo2',
        'idTec',
        'dateIns',
        'startTime',
        'endTime',
    ];
}

