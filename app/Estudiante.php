<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $primaryKey       =   "cedula_es";
    public $incrementing        =   false;
    public $timestamps          =   false;


    protected $with             =   ['turno'];

    public function turno(){
        return $this->belongsTo(Turno::class,'cedula_es','cedula_es');
    }
}
