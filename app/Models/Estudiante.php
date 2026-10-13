<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiante';
    protected $primaryKey = 'idCedula';
    public $timestamps = false;
    public $incrementing = false; // porque la cédula NO es autoincremental

    protected $fillable = [
        'idCedula',
        'id_persona',
        'idDireccion',
        'correo_electronico',
        'telefonoContactoFijo',
        'telefonoContactoCelular',
        'id_discapacidad',
        'id_situacionEconomica',
        'id_salud',
        'comentarioAdicional',
        'observaciones_recomendaciones',
        'firma_encargado',
        'id_situacionAcademica',
        'idDeclaracionDiscapacidad'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    public function direccion()
    {
        return $this->belongsTo(Direccion::class, 'idDireccion');
    }
    public function discapacidad()
{
    return $this->belongsTo(Discapacidad::class, 'id_discapacidad');
}

public function situacionEconomica()
{
    return $this->belongsTo(SituacionEconomica::class, 'id_situacionEconomica');
}

public function salud()
{
    return $this->belongsTo(SituacionSalud::class, 'id_salud');
}

public function situacionAcademica()
{
    return $this->belongsTo(SituacionAcademica::class, 'id_situacionAcademica');
}

public function declaracionDiscapacidad()
{
    return $this->belongsTo(DeclaracionDiscapacidad::class, 'idDeclaracionDiscapacidad');
}

}

