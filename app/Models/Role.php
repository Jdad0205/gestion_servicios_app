<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles'; // Define el nombre de la tabla en la base de datos
    protected $fillable = ['nombre']; // Los campos que se pueden asignar masivamente

    // Relación con los usuarios (Un rol puede tener muchos usuarios)
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
