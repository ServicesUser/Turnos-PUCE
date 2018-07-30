<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    protected $table        =   "horario_trabajo";
    public const CREATED_AT =   "creado_ht";
    public const UPDATED_AT =   "creado_ht";

    public function horario(){
        return $this->belongsTo(Horario::class,'id_ho','id_ho');
    }
}
