<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discapacidad extends Model
{
    protected $table = 'discapacidad';
    protected $primaryKey = 'idDiscapacidad';
    public $timestamps = false;

    protected $fillable = [
        'tipoDiscapacidad',
        'tiempoDiscapacidad'
    ];
}