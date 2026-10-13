<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CasoPersona extends Model
{
    // Nombre de la tabla
    protected $table = 'caso_persona';

    // Primary key personalizada
    protected $primaryKey = 'idCasoPersona';

    // No timestamps
    public $timestamps = false;

    // Campos asignables
    protected $fillable = [
        'id_caso',
        'id_persona',
        'tipo'
    ];

    // Relación con Casos
    public function caso()
    {
        return $this->belongsTo(Casos::class, 'id_caso', 'id_casos');
    }

    // Relación con Persona
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona', 'id_persona');
    }
}