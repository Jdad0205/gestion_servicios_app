<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'facturas';  // Cambiar si es necesario

    // Definir la clave primaria si es diferente a 'id'
    protected $primaryKey = 'id'; 

    // Habilitar o deshabilitar los timestamps si la tabla no los usa
    public $timestamps = true;  // true si usas created_at y updated_at

    // Definir las columnas que se pueden asignar masivamente
    protected $fillable = [
        'id_contrato',
        'id_cliente',
        'precio',
        'impuestos',
        'total_pagar',
        'fecha_emision',
    ];

    // Relación con el modelo Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    // Relación con el modelo Contrato
    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'id_contrato');
    }
}
