<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratoProducto extends Model
{
    use HasFactory;

    protected $table = 'contrato_productos'; // Especificar la tabla, si es necesario
    protected $fillable = ['id_contrato', 'id_producto', 'cantidad'];

    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'id_contrato');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
