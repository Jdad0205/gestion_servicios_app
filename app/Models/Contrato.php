<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $fillable = ['id_cliente', 'id_servicio', 'descripcion', 'fecha_inicio', 'fecha_fin'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'contrato_productos')->withPivot('cantidad');
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }
}
