<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Casos extends Model
{
    // Nombre de la tabla
    protected $table = 'casos';

    // Primary key personalizada
    protected $primaryKey = 'id_casos';

    // Desactivar timestamps (tu tabla NO tiene created_at ni updated_at)
    public $timestamps = false;

    // Campos asignables
    protected $fillable = [
        'descripcion',
        'fechaRegistro'
    ];

    // Relación: un caso puede tener muchas personas
    public function personas()
    {
        return $this->hasMany(CasoPersona::class, 'id_caso', 'id_casos');
    }
}