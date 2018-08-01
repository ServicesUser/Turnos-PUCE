<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    protected $table        =   "historial_turnos";

    protected $with         =   ['estado'];

    public function estado(){
        return $this->belongsTo(Estado::class,'id_et','id_et');
    }
}
