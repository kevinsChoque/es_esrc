<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TFormat4 extends Model
{
    protected $table='format4';
	protected $primaryKey='idFo4';
	public $incrementing=true;
	public $timestamps=false;

    protected $fillable = [
        'idFo4',
        'idFo2',
        'hourStart',
        'hourEnd',
        'proEps',
        'proRec',
        'agreement',
        'disagreement',
        'subsistes',
        'url',
        'stateConciliation',
    ];
}

