<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TFormat8 extends Model
{
    protected $table='format8';
	protected $primaryKey='idFo8';
	public $incrementing=true;
	public $timestamps=false;

    protected $fillable = [
        'idFo8',
        'idFo2',
        'fundamento',
        'url',
        'fr',
        'fa',
    ];
}

