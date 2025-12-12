<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Zxing\QrReader; 
use App\Models\Entrada;  
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Evento;


class QrValidationController extends Controller
{
     // Mostrar formulario para subir la imagen
     public function index()
     {
        $usuario = Auth::user();

        if (Gate::allows('admin')) {
            // Admin ve todos los eventos
            $eventos = Evento::all();
        } else {
            // Organizadores ven solo los suyos
            $eventos = Evento::where('user_id', $usuario->id)->get();
        }

        return view('validation.index', compact('eventos'));
     }

     public function show(Evento $evento)
     {
        
         return view('validation.show', compact('evento'));
     }


     public function validateImage(Request $request, Evento $evento)
     {
        $request->validate([
            'qr_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('qr_image')->getRealPath();

        $qrcode = new QrReader($imagePath);
        $codigo_qr = $qrcode->text();

        if(!$codigo_qr) {
            return back()->with('error', 'No se pudo leer el código QR.');
        }

        
        $entrada = Entrada::with(['lote.evento.usuario'])
            ->where('codigo_qr', $codigo_qr)
            ->whereHas('lote', function($query) use ($evento) {
                $query->where('evento_id', $evento->id);
            })
            ->first();

        if(!$entrada) {
            return back()->with('error', 'Entrada no encontrada.');
        }

        return view('validation.confirmado', [
            'entrada' => $entrada,
            'usuario' => $entrada->lote->usuario
        ]);
     }

     public function cameraView(Evento $evento)
    {
        return view('validation.camara', compact('evento'));
    }

    public function validateCamera(Request $request, Evento $evento)
    {
        $qr = $request->input('qr_text');
    
        // 1 Validar QR vacío
        if (!$qr) {
            return response()->json([
                'success' => false,
                'message' => 'QR vacío.'
            ], 400);
        }
    
        // 2 Buscar la entrada por QR y evento
        $entrada = Entrada::with(['lote.evento.usuario'])
            ->where('codigo_qr', $qr)
            ->whereHas('lote', function($q) use ($evento) {
                $q->where('evento_id', $evento->id);
            })
            ->first();
    
        // 3 Entrada no encontrada
        if (!$entrada) {
            return response()->json([
                'success' => false,
                'message' => 'Entrada no encontrada para este evento.'
            ], 404);
        }
    
        // 4 Verificar si el evento ya terminó
        if ($evento->yaTermino()) {
            return response()->json([
                'success' => false,
                'message' => 'El evento ya terminó. No se pueden validar más entradas.',
                'entrada' => $entrada
            ], 400);
        }
    
        // 5 Verificar si ya fue usada
        if ($entrada->is_used) {
            return response()->json([
                'success' => false,
                'used' => true,
                'message' => 'Esta entrada ya fue utilizada.',
                'entrada' => $entrada
            ], 400);
        }
    
        // 6 Todo OK → marcar como usada
        $entrada->is_used = true;
        $entrada->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Entrada validada correctamente.',
            'entrada' => $entrada
        ]);
    }
    
}

