<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $primaryKey   =   "id_tu";
    public const CREATED_AT =   "creado_tu";
    public const UPDATED_AT =   "actualizado_tu";
    public $incrementing    =   false;



    public function antendio(){
        return $this->belongsTo(User::class,'id_us','id');
    }

    public function horario(){
        return $this->belongsTo(Horario::class,'id_ho','id_ho');
    }

    public function estudiante(){
        return $this->hasOne(Estudiante::class,'cedula_es','cedula_es');
    }

}
