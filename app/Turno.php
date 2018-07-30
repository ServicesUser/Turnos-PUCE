<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $primaryKey   =   "id_tu";
    public const CREATED_AT =   "creado_tu";
    public const UPDATED_AT =   "actualizado_tu";
    public $incrementing    =   false;

}
