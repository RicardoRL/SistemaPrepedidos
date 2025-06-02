<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrepedidoController;
use App\Services\BanxicoService;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();

    $user = User::updateOrCreate([
        'email' => $googleUser->getEmail(),
    ], [
        'name' => $googleUser->getName(),
        'google_id' => $googleUser->getId(),
    ]);

    Auth::login($user);

    return redirect('/admin/articulos'); // o donde quieras
});

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/tipo-cambio', function (BanxicoService $banxicoService) {
    $tasa = $banxicoService->obtenerTipoCambio();
    return response()->json(['tipo_cambio' => $tasa]);
});

Route::prefix('admin')->group(function () {
    Route::get('/articulos', [ArticuloController::class, 'index'])->name('articulos.index');
    Route::get('/articulos/listado', [ArticuloController::class, 'listado'])->name('articulos.listado');
    Route::post('/articulos', [ArticuloController::class, 'store'])->name('articulos.store');
    Route::put('/articulos/{articulo}', [ArticuloController::class, 'update'])->name('articulos.update');
    Route::delete('/articulos/{articulo}', [ArticuloController::class, 'destroy'])->name('articulos.destroy');
    Route::put('/articulos/{id}/estado', [ArticuloController::class, 'cambiarEstado'])->name('articulos.estado');
});

Route::prefix('admin')->group(function () {
    Route::get('/prepedidos', [PrepedidoController::class, 'index'])->name('prepedidos.index');
    Route::get('prepedidos/{id}', [PrepedidoController::class, 'show'])->name('prepedidos.show');
    Route::post('/prepedidos', [PrepedidoController::class, 'store'])->name('prepedidos.store');
    Route::put('/prepedidos/{prepedido}', [PrepedidoController::class, 'update'])->name('prepedidos.update');
    Route::delete('/prepedidos/{prepedido}', [PrepedidoController::class, 'destroy'])->name('prepedidos.destroy');
});

