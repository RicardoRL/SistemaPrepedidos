<?php

namespace App\Http\Controllers;

use App\Models\Prepedido;
use App\Models\Articulo;
use Illuminate\Http\Request;
use App\Models\PrepedidoDetalle;
use Illuminate\Support\Facades\DB;

class PrepedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Prepedido::with('detalles');

        if ($request->filled('desde') && $request->filled('hasta')) {
            $query->whereBetween('fecha', [$request->desde, $request->hasta]);
        }

        $prepedidos = $query->orderByDesc('fecha')->paginate(10);

        return view('prepedidos.index', compact('prepedidos'));
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
        $request->validate([
            'correo' => 'required|email',
            'carrito' => 'required|array|min:1',
        ]);

        try {
            DB::beginTransaction();

            $subtotal = collect($request->carrito)->sum(function ($item) {
                return $item['precio_pesos'] * $item['cantidad'];
            });
            $impuestos = $subtotal * 0.16;
            $total = $subtotal + $impuestos;
    
            $prepedido = Prepedido::create([
                'folio' => 'PRE-' . now()->timestamp,
                'correo' => $request['correo'],
                'subtotal' => $subtotal,
                'impuestos' => $impuestos,
                'total' => $total,
                'fecha' => now()
            ]);
    
            foreach ($request->carrito as $producto) {
                $articulo = Articulo::find($producto['id']);

                PrepedidoDetalle::create([
                    'prepedido_id' => $prepedido->id,
                    'articulo_id' => $producto['id'],
                    'cantidad' => $producto['cantidad'],
                    'precioPesos' => $producto['precio_pesos'],
                    'precioDolares' => $producto['precio_dolares']
                ]);                

                if (!$articulo) {
                    throw new \Exception("El artículo con ID {$producto['id']} no existe.");
                }
    
                if ($articulo->stock < $producto['cantidad']) {
                    throw new \Exception("No hay suficiente stock para el artículo: {$articulo->nombre}");
                }

                // Actualizar el stock del artículo
                if ($articulo) {
                    $articulo->stock -= $producto['cantidad'];
                    $articulo->save();
                }
            }
    
            DB::commit();
    
            return response()->json(['success' => true, 'message' => 'Prepedido guardado con éxito']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error al procesar el prepedido'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $prepedido = Prepedido::with('detalles.articulo')->findOrFail($id);

        return response()->json([
            'folio' => $prepedido->folio,
            'correo' => $prepedido->correo,
            'fecha' => $prepedido->fecha,
            'detalles' => $prepedido->detalles
        ]);
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
