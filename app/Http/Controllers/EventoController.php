<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $eventos = Evento::all();
        return view('eventos.index', compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('eventos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'titulo' => 'required',
            'fecha' => 'required|date'
        ]);

        Evento::create($request->all());

        return redirect()->route('eventos.index')->with('success', 'Evento creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Evento $evento)
    {
        //
        return view('eventos.show', compact('evento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evento $evento)
    {
        //
        return view('eventos.edit', compact('evento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evento $evento)
    {
        //

        $request->validate([
            'titulo' => 'required',
            'fecha' => 'required|date'
        ]);

        $evento->update($request->all());

        return redirect()->route('eventos.index')->with('success', 'Evento actualizado con éxito.');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evento $evento)
    {
        //
        $evento->delete();
        return redirect()->route('eventos.index')->with('success', 'Evento eliminado');
    }
}
