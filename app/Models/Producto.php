<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'precio'];

    public function contratos()
    {
        return $this->hasMany(Contrato::class);
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }
}
