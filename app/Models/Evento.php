<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    //

    protected $fillable = ['user_id','titulo', 'descripcion', 'fecha', 'direccion'];

    
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lotes()
    {
        return $this->hasMany(Lote::class);
    }


}
