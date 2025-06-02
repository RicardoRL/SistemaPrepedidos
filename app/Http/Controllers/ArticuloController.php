<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articulos = Articulo::where('activo', true)->whereNull('deleted_at')->get();

        return view('articulos.index', compact('articulos'));
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
            'sku' => 'required|unique:articulos,sku|max:20',
            'nombre' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'descripcion_corta' => 'required|max:255',
            'descripcion_larga' => 'required',
            'precio_pesos' => 'required|numeric|min:0.01',
            'precio_dolares' => 'required|numeric|min:0.01',
            'imagen' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'stock' => 'required|integer|min:0',
            'fecha_vigencia' => 'required|date',
        ]);

        $data = $request->except('_token');

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('articulos', 'public');
        }

        $data['activo'] = true;

        Articulo::create($data);

        return redirect()->route('articulos.index')->with('success', 'Artículo guardado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Articulo $articulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articulo $articulo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Articulo $articulo)
    {
        $request->validate([
            'sku' => "required|max:20|unique:articulos,sku,{$articulo->id}",
            'nombre' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'descripcion_corta' => 'required|max:255',
            'descripcion_larga' => 'required',
            'precio_pesos' => 'required|numeric|min:0.01',
            'precio_dolares' => 'required|numeric|min:0.01',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'stock' => 'required|integer|min:0',
            'fecha_vigencia' => 'required|date',
        ]);
    
        $articulo = Articulo::findOrFail($articulo->id);
    
        $data = $request->except('_token', '_method');
    
        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('articulos', 'public');
        }
    
        $articulo->update($data);
    
        return redirect()->route('articulos.index')->with('success', 'Artículo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Articulo $articulo)
    {
        $articulo = Articulo::findOrFail($articulo->id);
        
        $articulo->delete();

        return redirect()->route('articulos.index')->with('success', 'Artículo eliminado correctamente.');
    }
}
