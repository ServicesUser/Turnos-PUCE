<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    protected $table    =   "historial_turnos";
    const CREATED_AT    =   'fecha_ht';
    const UPDATED_AT    =   'fecha_ht';
}
