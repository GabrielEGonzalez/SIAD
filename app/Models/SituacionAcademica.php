<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SituacionAcademica extends Model
{
    protected $table = 'situacionacademica';
    protected $primaryKey = 'idSituacionAcademica';
    public $timestamps = false;

    protected $fillable = [
        'facultad',
        'carrera',
        'anioIngreso',
        'anioCursa'
    ];
}

