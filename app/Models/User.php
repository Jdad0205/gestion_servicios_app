<?php

// app/Models/User.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Nombre de la tabla en la base de datos
    protected $table = 'usuarios';  // Cambiar si es necesario

    // Definir la clave primaria si es diferente a 'id'
    protected $primaryKey = 'id';

    // Si no estás usando 'created_at' y 'updated_at', pon la siguiente línea
    public $timestamps = false;

    // Definir las columnas que se pueden asignar masivamente
    protected $fillable = [
        'nombre_usuario', 
        'correo', 
        'contrasena',
        'id_rol',
    ];

    // Métodos de autenticación personalizados
    public function getAuthIdentifierName()
    {
        return 'id';  // Cambiar si usas otro campo como identificador
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();  // Devuelve la clave primaria
    }

    public function getAuthPassword()
    {
        return $this->contrasena;  // Campo de la contraseña
    }

    public function getRememberToken()
    {
        return $this->remember_token;  // Token de "remember me" si es necesario
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }
}
