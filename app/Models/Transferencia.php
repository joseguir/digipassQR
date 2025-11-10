<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transferencia extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'entrada_id',
        'remitente_id',
        'receptor_id',
        'estado',
    ];

    // Relaciones
    public function entrada()
    {
        return $this->belongsTo(Entrada::class);
    }

    public function remitente()
    {
        return $this->belongsTo(User::class, 'remitente_id');
    }

    public function receptor()
    {
        return $this->belongsTo(User::class, 'receptor_id');
    }
}
