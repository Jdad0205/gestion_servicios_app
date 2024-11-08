<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PQR extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla (si es diferente al nombre por defecto que sería plural del modelo)
    protected $table = 'pqr';

    // Definir los campos que se pueden asignar masivamente
    protected $fillable = [
        'id_cliente',
        'tipo',
        'descripcion',
        'estado',
        'fecha_creacion',
        'created_at',
        'updated_at',
    ];

    // Definir los campos de tipo fecha
    protected $dates = ['fecha_creacion', 'created_at', 'updated_at'];

    // En el modelo PQR
public function cliente()
{
    return $this->belongsTo(Cliente::class, 'id_cliente');
}

}
