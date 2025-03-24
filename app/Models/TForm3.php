<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TForm3 extends Model
{
    protected $table='form3';
	protected $primaryKey='idF3';
	public $incrementing=true;
	public $timestamps=false;

    protected $fillable = [
        'idF3',
        'idPro',
        'medidor',
        'diametro',
        'marca',
        'clase',
        'modelo',
        'capacidad',
        'volumen',
        'resultado',
        'calificacion',
        'obs',
        'hora',
        'fr',
        'fa'
    ];
}

