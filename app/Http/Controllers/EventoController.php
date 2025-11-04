<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            'titulo' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'direccion' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/eventos'), $filename);
            $img = 'img/eventos/' . $filename; // ruta relativa desde public
        }


        Evento::create([
            'user_id' => Auth::id(), // <-- asignamos el usuario actual
            'titulo' => $request->titulo,
            'img' => $img, //enlace de la imagen
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'direccion' => $request->direccion,
        ]);

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
        $request->validate([
            'titulo' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'fecha' => 'required|date',
        ]);
    
        // Tomamos todos los datos del formulario
        $data = $request->all();
    
        // Si se sube una nueva imagen
        if ($request->hasFile('img')) {
            // Borrar la imagen anterior si existe
            if ($evento->img && file_exists(public_path($evento->img))) {
                unlink(public_path($evento->img));
            }
    
            // Guardar la nueva imagen en public/img/eventos
            $file = $request->file('img');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/eventos'), $filename);
    
            // Guardar la ruta relativa
            $data['img'] = 'img/eventos/' . $filename;
        }
    
        // Actualizar el evento con los datos (incluyendo la nueva imagen si la hay)
        $evento->update($data);
    
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
