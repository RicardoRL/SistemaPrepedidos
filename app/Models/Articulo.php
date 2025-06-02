<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articulo extends Model
{
  use SoftDeletes;

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
