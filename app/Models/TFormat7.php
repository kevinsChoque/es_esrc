<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TFormat7 extends Model
{
    protected $table='format7';
	protected $primaryKey='idFo7';
	public $incrementing=true;
	public $timestamps=false;

    protected $fillable = [
        'idFo7',
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

