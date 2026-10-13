<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';
    protected $primaryKey = 'id_persona';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido',
        'edad',
        'tipo'
    ];

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'id_persona');
    }
    public function casos()
{
    return $this->hasMany(CasoPersona::class, 'id_persona', 'id_persona');
}

}

