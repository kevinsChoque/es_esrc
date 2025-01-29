<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TUsers extends Model
{
    protected $table='user';
	protected $primaryKey='idUse';
	public $incrementing=true;
	public $timestamps=false;

    protected $fillable = [
        'idUse',
        'dni',
        'nombres',
        'apellidos',
        'celular',
        'correo',
        'tipo',
        'state',
        'password',
        'fr',
        'fa',
    ];
}
