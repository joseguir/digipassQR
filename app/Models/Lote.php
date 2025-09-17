<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Evento;
use App\Models\Entrada;

class Lote extends Model
{
    //

    use HasFactory;

    protected $fillable = ['evento_id', 
    'nombre', 'cantidad',
    'precio',
    'fecha_inicio', 'fecha_fin'];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin'    => 'datetime',
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    public function entradas()
    {
        return $this->hasMany(Entrada::class);
    }
}
