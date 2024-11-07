<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Definir la tabla
    protected $table = 'productos';

    // Definir los campos que pueden ser llenados masivamente
    protected $fillable = [
        'nombre', // nombre del producto
        'descripcion', // descripción del producto
        'precio', // precio del producto
    ];

    // Deshabilitar la gestión de timestamps si no los necesitas (si tu tabla no usa created_at y updated_at)
    public $timestamps = false;
}
