<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\EstadoEntrada;
use App\Models\User;
use App\Models\Evento;
use App\Models\EstadosEntrada;
use App\Models\Lote;
use Illuminate\Support\Str;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;

class ClientesController extends Controller
{
    public function index()
    {
        // Traer todos los eventos al dashboard
        $eventos = Evento::all();
        return view('home', compact('eventos'));
    }
    public function eventoDetalle($id)
    {
        // Buscar el evento con sus lotes asociados
        $evento = Evento::with('lotes')->findOrFail($id);

        // Obtener solo los lotes de ese evento
        $lotes = $evento->lotes;

        // Retornar a una vista donde los muestres
        return view('frontend.pages.evento', compact('evento', 'lotes'));
    }
    public function iniciarCompra($loteId)
    {
        $user = auth()->user();

        // Si no es cliente 
        if ($user->role_id !== 3) {
            return redirect('/')->with('error', 'Solo los clientes pueden comprar entradas.');
        }

        $lote = Lote::findOrFail($loteId);
        $evento = $lote->evento;
        
        return view('frontend.pages.comprar', compact('lote', 'evento'));
    }
    
    public function guardarCompra(Request $request)
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
            'estado_id'   => 2, //no usada
            'fecha_compra'=> now(),
        ]);

        // return redirect()->route('entradas.index')->with('success', 'Entrada creada correctamente');

        return redirect()->route('dashboard')->with('success', '¡Compra realizada con éxito!');
    }
}
