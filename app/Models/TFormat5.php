<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TFormat5 extends Model
{
    protected $table='format5';
	protected $primaryKey='idFo5';
	public $incrementing=true;
	public $timestamps=false;

    protected $fillable = [
        'idFo5',
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

