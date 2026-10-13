<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $table = 'seguimiento';
    protected $primaryKey = 'idSeguimiento';
    public $timestamps = false;

    protected $fillable = [
        'id_estudiante',
        'id_caso',
        'ayudaTecnica',
        'remitido',
        'motivo_ss',
        'accionesSeguridadR',
        'observaciones',
        'firma_user',
        'fecha',
        'responsableSeguimiento'
    ];

    // ===============================
    // RELACIONES
    // ===============================

    /**
     * Un seguimiento pertenece a un estudiante.
     */
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante', 'idCedula');
    }

    /**
     * Un seguimiento pertenece a un caso.
     */
    public function caso()
    {
        return $this->belongsTo(Casos::class, 'id_caso', 'id_casos');
    }

    /**
     * RELACIÓN CON USUARIO (si deseas mostrar la firma_user)
     * Solo si tienes tabla usuarios y el campo coincide.
     * Si no, se deja comentado.
     */
    // public function usuario()
    // {
    //     return $this->belongsTo(User::class, 'firma_user', 'nombre');
    // }
}


