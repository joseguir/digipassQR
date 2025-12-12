<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    //

    protected $fillable = ['user_id','titulo', 'img', 'descripcion', 'fecha', 'direccion'];

    
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lotes()
    {
        return $this->hasMany(Lote::class);
    }

    // Método para saber si el evento ya terminó
    public function yaTermino()
    {
        return Carbon::parse($this->fecha)->endOfDay()->lt(Carbon::now());
    }

    // Método para saber si el evento es hoy o futuro
    public function estaActivo()
    {
        return ! $this->yaTermino();
    }
}
