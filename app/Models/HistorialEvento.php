<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class HistorialEvento extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'usuario_destino_id',
        'evento_id',
        'cantidad',
        'tipo_accion',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function usuario_destino()
    {
        return $this->belongsTo(User::class, 'usuario_destino_id');
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
