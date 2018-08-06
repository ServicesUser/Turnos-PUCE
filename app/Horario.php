<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $primaryKey       =   "id_ho";
    public $incrementing        =   false;
    public const UPDATED_AT     =   'creado_ho';
    public const CREATED_AT     =   'creado_ho';

    protected $with             =   ['dia','responsable'];


    public function turnos(){
        return $this->hasMany(Turno::class,'id_ho','id_ho');
    }

    public function dia(){
        return $this->belongsTo(Dia::class,'id_di','id_di');
    }

    public function responsable(){
        return $this->belongsTo(User::class,'id','id');
    }
}
