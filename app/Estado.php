<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table        =   "estado_turno";
    protected $primaryKey   =   "id_et";
    public $timestamps      =   false;
}
