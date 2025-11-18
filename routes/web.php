<?php

use App\Http\Controllers\EventoController;
use App\Http\Controllers\ProfileController;
use App\Models\Evento;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\QrValidationController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HistorialController;


// =========== Frontend de clientes ===============
Route::get('/', [ClientesController::class, 'index'])->name('home');
Route::get('/evento-detalle/{id}', [ClientesController::class, 'eventoDetalle'])->name('eventoDetalle');

// Solo usuarios logueados pueden comprar y ver sus entradas (versión pública)
Route::middleware(['auth'])->group(function () {
    Route::get('/comprar/{lote}', [ClientesController::class, 'iniciarCompra'])->name('comprar.lote');
    Route::post('/comprar', [ClientesController::class, 'guardarCompra'])->name('comprar.guardar');
    
    Route::get('/entradas/confirmacion/{ids}', 
        [ClientesController::class, 'ticketConfirmacion']
    )->name('entradas.ticketConfirmacion');


});

// =========== Panel Admin / Organizadores / Clientes (solo para entradas) ===============
Route::prefix('admin')->middleware(['auth', 'role:admin,organizador,cliente'])->group(function () {
    Route::get('entradas', [EntradaController::class, 'index'])->name('entradas.index');
    Route::get('entradas/{entrada}', [EntradaController::class, 'show'])->name('entradas.show');
    Route::get('entradas/{entrada}/descargar-qr', [EntradaController::class, 'descargarQr'])
        ->name('entradas.qr.download');
});

// =========== Panel exclusivo para Admin ===============
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('usuarios', UserController::class);
    Route::resource('roles', RoleController::class);
});

// =========== Panel Admin + Organizador (eventos y lotes) ===============
Route::prefix('admin')->middleware(['auth', 'role:admin,organizador'])->group(function () {
    Route::resource('lotes', LoteController::class);
    Route::resource('eventos', EventoController::class);
});

// =========== Validación de QR (solo admin y organizador) ===============
Route::prefix('admin')->middleware(['auth', 'role:admin,organizador'])->group(function () {
    Route::get('validation', [QrValidationController::class, 'index'])->name('validation.index');
    Route::get('validation/{evento}', [QrValidationController::class, 'show'])->name('validation.show');
    Route::post('validation/{evento}', [QrValidationController::class, 'validateImage'])->name('validation.validate');
    Route::get('/validation/{evento}/camera', [QrValidationController::class, 'cameraView'])
    ->name('validation.camera');
    
    Route::post('/validation/{evento}/scan', [QRValidationController::class, 'validateCamera'])
        ->name('validation.camera.validate');
});

// =========== Rutas de Notificacion ===============
Route::prefix('admin')->middleware(['auth', 'role:cliente'])->group( function () {
    Route::get('notificaciones', [NotificacionController::class, 'index'])->name('notificaciones.index');
});

Route::get('/admin', function () {
    return view('dashboard');
})->name('dashboard');

// =========== Perfil de usuario ===============
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =========== Rutas de Google ===============
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

// =========== Rutas de Historial ===============

Route::prefix('admin')->middleware(['auth', 'role:cliente,organizador'])->group(function () {
    Route::get('historial', [HistorialController::class, 'index'])->name('historial.index');
});

require __DIR__.'/auth.php';
