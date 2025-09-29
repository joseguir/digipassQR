<?php

namespace App\Http\Controllers;

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
        return view('welcome', compact('eventos'));
    }
}
