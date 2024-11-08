<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'precio'];

    public function contratoProductos()
    {
        return $this->hasMany(ContratoProducto::class);
    }

    public function facturaProductos()
    {
        return $this->hasMany(FacturaProducto::class);
    }
}
