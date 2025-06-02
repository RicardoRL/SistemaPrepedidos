<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
  protected $fillable = [
    'sku',
    'nombre',
    'descripcion_corta',
    'descripcion_larga',
    'precio_pesos',
    'precio_dolares',
    'imagen',
    'stock',
    'fecha_vigencia',
    'activo',
  ];
}
