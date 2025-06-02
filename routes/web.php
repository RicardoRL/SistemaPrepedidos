<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticuloController;
use App\Services\BanxicoService;

Route::get('/', function () {
    return redirect()->route('articulos.index');
});

Route::get('/tipo-cambio', function (BanxicoService $banxicoService) {
    $tasa = $banxicoService->obtenerTipoCambio();
    return response()->json(['tipo_cambio' => $tasa]);
});

Route::prefix('admin')->group(function () {
    Route::get('/articulos', [ArticuloController::class, 'index'])->name('articulos.index');
    Route::post('/articulos', [ArticuloController::class, 'store'])->name('articulos.store');
    Route::put('/articulos/{articulo}', [ArticuloController::class, 'update'])->name('articulos.update');

});

