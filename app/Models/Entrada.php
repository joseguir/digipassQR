<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\EstadoEntrada;  
use App\Models\Lote;
use App\Models\Evento;

class Entrada extends Model
{
    //

    use HasFactory;

    protected $fillable = [
        'lote_id',
        'usuario_id',
        'codigo_qr',
        'estado_id',
        'fecha_compra'
    ];

    public function lote()
    {
        return $this->belongsTo(Lote::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function estado()
    {
        return $this->belongsTo(EstadoEntrada::class, 'estado_id');
    }
}
