<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrepedidoDetalle extends Model
{
    protected $table = 'prepedido_detalle';
    
    protected $fillable = [
        'prepedido_id',
        'articulo_id',
        'cantidad',
        'precioDolares',
        'precioPesos',
    ];

    public function prepedido()
    {
        return $this->belongsTo(Prepedido::class);
    }

    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }
}
