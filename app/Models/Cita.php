<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = 'cita';
    protected $primaryKey = 'idCita';
    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_hora',
        'tipo',
        'idPersona',
        'idUsuario',
        'idCaso',
        'prioridad',
        'estado'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'idPersona', 'id_Persona');
    }

    public function caso()
    {
        return $this->belongsTo(Casos::class, 'idCaso', 'id_casos');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario', 'idCedula');
    }
}

