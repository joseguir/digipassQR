<?php

use App\Http\Controllers\EventoController;
use App\Http\Controllers\ProfileController;
use App\Models\Evento;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;


    /* Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index']);
    });
    */

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('usuarios', UserController::class);
    Route::resource('roles', RoleController::class);
});

Route::get('/admin', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('/admin/eventos', EventoController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
