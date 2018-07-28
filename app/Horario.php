<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $primaryKey       =   "id_ho";
    public $timestamps          =   false;
    public $incrementing        =   false;
}
