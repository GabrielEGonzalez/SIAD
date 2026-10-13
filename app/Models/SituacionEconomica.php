<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SituacionEconomica extends Model
{
    protected $table = 'situacioneconomica';
    protected $primaryKey = 'idSituacionEconomica';
    public $timestamps = false;

    protected $fillable = [
        'trabaja',
        'especificacion',
        'telefono',
        'parentesco'
    ];
}

