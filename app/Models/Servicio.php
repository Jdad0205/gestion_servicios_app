<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'firma'];
     // Deshabilitar la gestión de timestamps si no los necesitas (si tu tabla no usa created_at y updated_at)
     public $timestamps = false;
}
