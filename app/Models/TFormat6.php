<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TFormat6 extends Model
{
    protected $table='format6';
	protected $primaryKey='idFo6';
	public $incrementing=true;
	public $timestamps=false;

    protected $fillable = [
        'idFo6',
        'idFo2',
        'inscription',
        'date',
        'hour',
        'obs',
        'url',
        'fr',
        'fa',
    ];
}

