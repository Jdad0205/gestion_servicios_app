<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'correo', 'direccion', 'telefono', 'detalle'];

    public function contratos()
    {
        return $this->hasMany(Contrato::class);
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'id_cliente');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
