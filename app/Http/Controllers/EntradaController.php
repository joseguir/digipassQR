<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\EstadoEntrada;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EstadosEntrada;
use App\Models\Lote;
use Illuminate\Support\Str;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $entradas = Entrada::with(['lote.evento', 'usuario', 'estado'])->get();
        return view('entradas.index', compact('entradas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $lotes = Lote::with('evento')->get();
        $usuarios = User::all();
        $estados = EstadoEntrada::all();

        return view('entradas.create', compact('lotes', 'usuarios', 'estados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'lote_id'    => 'required|exists:lotes,id',
            'usuario_id' => 'required|exists:users,id',
            'estado_id'  => 'required|exists:estados_entrada,id',
        ]);

        Entrada::create([
            'lote_id'     => $request->lote_id,
            'usuario_id'  => $request->usuario_id,
            'codigo_qr'   => Str::uuid(), // genera código único
            'estado_id'   => $request->estado_id,
            'fecha_compra'=> now(),
        ]);

        return redirect()->route('entradas.index')->with('success', 'Entrada creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Entrada $entrada)
    {
        //
        $entrada->load(['lote.evento', 'usuario', 'estado']);
        return view('entradas.show', compact('entrada'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entrada $entrada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entrada $entrada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrada $entrada)
    {
        //
    }

    public function descargarQr(Entrada $entrada)
    {
        // Genera el QR en formato PNG
        $filename = 'entrada-' . $entrada->id . '.png';
        
        $qr = QrCode::format('png')->size(300)->generate($entrada->codigo_qr);

        return response($qr)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', "attachment; filename={$filename}");
    }
}
