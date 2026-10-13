<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SituacionSalud extends Model
{
    protected $table = 'situacionsalud';
    protected $primaryKey = 'idSalud';
    public $timestamps = false;

    protected $fillable = [
        'telefono',
        'especifique',
        'parentesco',
        'recibeTerapia'
    ];
}
