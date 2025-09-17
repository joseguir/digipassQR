<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Entrada;

class EstadoEntrada extends Model
{
    //

    use HasFactory;

    protected $table = 'estados_entrada';

    protected $fillable = [
        'nombre',
    ];

    public function entradas()
    {
        return $this->hasMany(Entrada::class);
    }
}
