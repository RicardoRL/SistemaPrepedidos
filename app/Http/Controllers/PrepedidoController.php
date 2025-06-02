<?php

namespace App\Http\Controllers;

use App\Models\Prepedido;
use App\Models\Articulo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PrepedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articulos = Articulo::where('activo', true)
                             ->whereDate('fecha_vigencia', '>=', now())
                             ->whereNull('deleted_at')
                             ->paginate(5);

        return view('prepedidos.index', compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Prepedido $prepedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prepedido $prepedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prepedido $prepedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prepedido $prepedido)
    {
        //
    }
}
