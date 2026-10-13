<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Usar Authenticatable para el login
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{

    protected $table = 'usuario';

    protected $primaryKey = 'idCedula';

    public $timestamps = false; 

    protected $fillable = [
        'idCedula',
        'nombre',
        'apellido',
        'correo',
        'contraseña',
        'rol',
    ];

    // Campos que deben ocultarse (ej. al serializar a JSON)
    protected $hidden = [
        'contraseña',
    ];
    
    // Especificar el campo de contraseña para las funciones de autenticación
    public function getAuthPassword()
    {
        return $this->contraseña;
    }
}
