<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeclaracionDiscapacidad extends Model
{
    protected $table = 'declaraciondiscapacidad';
    protected $primaryKey = 'idDeclaracionDiscap';
    public $timestamps = false;

    protected $fillable = [
        'diagnostico',
        'dificultad',
        'certificado',
        'estadoCertificado'
    ];
}
