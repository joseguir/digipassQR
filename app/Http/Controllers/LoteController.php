<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lote;

class LoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $usuario = Auth::user();

        $eventos = $usuario->eventos()->with('lotes')->get();

        $lotes = $eventos->pluck('lotes')->flatten();

        return view('lotes.index', compact('lotes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $usuario = Auth::user();

        $eventos = $usuario->eventos;

        // dd($eventos);

        return view('lotes.create', compact('eventos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'nombre' => 'required|string',
            'cantidad' => 'required|integer|min:1',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        Lote::create($request->all());
        return redirect()->route('lotes.index')->with('success', 'Lote creado correctamente');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lote $lote)
    {
        //
        $usuario = Auth::user();
        $eventos = $usuario->eventos()->get(); // Solo eventos propios
        
        return view('lotes.edit', compact('lote', 'eventos')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lote $lote)
    {
        //

        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        $lote->update($request->all());
        return redirect()->route('lotes.index')->with('success', 'Lote actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lote $lote)
    {
        //
        $lote->delete();
        return redirect()->route('lotes.index')->with('success', 'Lote eliminado correctamente');
    }
}
