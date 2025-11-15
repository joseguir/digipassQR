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

        if (!$qr) {
            return response()->json(['error' => 'QR vacío'], 400);
        }

        // Buscar la entrada como lo hacías antes
        $entrada = Entrada::with(['lote.evento.usuario'])
            ->where('codigo_qr', $qr)
            ->whereHas('lote', function($q) use ($evento) {
                $q->where('evento_id', $evento->id);
            })
            ->first();

        if (!$entrada) {
            return response()->json(['error' => 'Entrada no encontrada'], 404);
        }

        return response()->json([
            'success' => true,
            'entrada' => $entrada
        ]);
    }
}

