<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prepedido extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'folio',
        'correo',
        'subtotal',
        'impuestos',
        'total',
        'fecha',
    ];

    public function detalles()
    {
        return $this->hasMany(PrepedidoDetalle::class);
    }
}
