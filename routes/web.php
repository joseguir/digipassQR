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


    /* Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index']);
    });
    */

Route::get('/', [ClientesController::class, 'index'])->name('dashboard');


Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('usuarios', UserController::class);
    Route::resource('roles', RoleController::class);
});

Route::prefix('admin')->middleware(['auth', 'role:admin, organizador'])->group(function () {
    Route::resource('lotes', LoteController::class);
    Route::resource('eventos', EventoController::class);
    Route::resource('entradas', EntradaController::class);
    Route::get('entradas/{entrada}/descargar-qr', [EntradaController::class, 'descargarQr'])->name('entradas.qr.download');
});

// Bloque separado para validación de QR
Route::prefix('admin')->middleware(['auth', 'role:admin,organizador'])->group(function () {
    Route::get('validation', [QrValidationController::class, 'index'])->name('validation.index');
    Route::get('validation/{evento}', [QrValidationController::class, 'show'])->name('validation.show');
    Route::post('validation/{evento}', [QrValidationController::class, 'validateImage'])->name('validation.validate');
    
});

Route::get('/admin', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
