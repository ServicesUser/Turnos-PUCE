<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $primaryKey       =   "id_ho";
    public $timestamps          =   false;
    public $incrementing        =   false;

    protected $with             =   ['dia'];

    public function dia(){
        return $this->belongsTo(Dia::class,'id_di','id_di');
    }
}
