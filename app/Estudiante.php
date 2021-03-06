<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Estudiante extends Model
{
    use Notifiable;

    protected $primaryKey       =   "cedula_es";
    public $incrementing        =   false;
    public $timestamps          =   false;

    //protected $with =   ['turno'];
    
    protected $casts = [
      'validado_es' => 'bool'
    ];

    public function routeNotificationForMail($notification)
    {
        return $this->email_es;
    }

    public function turno(){
        return $this->belongsTo(Turno::class,'cedula_es','cedula_es');
    }
}
