<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TFormat9 extends Model
{
    protected $table='format9';
	protected $primaryKey='idFo9';
	public $incrementing=true;
	public $timestamps=false;

    protected $fillable = [
        'idFo9',
        'idFo2',
        'fundamento',
        'url',
        'fr',
        'fa',
    ];
}

