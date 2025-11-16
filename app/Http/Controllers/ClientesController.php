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
        // if ($user->role_id !== 3) {
        //     return redirect('/')->with('error', 'Solo los clientes pueden comprar entradas.');
        // }

        $lote = Lote::findOrFail($loteId);
        $evento = $lote->evento;
        
        return view('frontend.pages.comprar', compact('lote', 'evento', 'user'));
    }
    
    public function guardarCompra(Request $request)
    {
        $request->validate([
            'lote_id'    => 'required|exists:lotes,id',
            'usuario_id' => 'required|exists:users,id',
            'cantidad'   => 'required|integer|min:1',
        ]);

        $entradaIds = [];

        for ($i = 0; $i < $request->cantidad; $i++) {
            $entrada = Entrada::create([
                'lote_id'      => $request->lote_id,
                'usuario_id'   => $request->usuario_id,
                'codigo_qr'    => Str::uuid(),
                'estado_id'    => 2,
                'fecha_compra' => now(),
                'is_used'      => false,
            ]);

            $entradaIds[] = $entrada->id;
        }

        return redirect()
            ->route('entradas.ticketConfirmacion', ['ids' => implode(',', $entradaIds)])
            ->with('success', '¡Compra realizada con éxito!');
    }


    
    public function ticketConfirmacion($ids)
    {
        $idsArray = explode(',', $ids);

        $entradas = Entrada::with('lote.evento', 'usuario')
            ->whereIn('id', $idsArray)
            ->get();

        if ($entradas->isEmpty()) {
            abort(404);
        }

        // Seguridad: evitar ver entradas ajenas
        foreach ($entradas as $entrada) {
            if ($entrada->usuario_id !== auth()->id()) {
                abort(403);
            }
        }

        $usuario = $entradas->first()->usuario;
        $lote = $entradas->first()->lote;
        $evento = $lote->evento;

        return view('frontend.pages.ticket-factura', compact(
            'entradas', 'usuario', 'lote', 'evento'
        ));
    }


}
