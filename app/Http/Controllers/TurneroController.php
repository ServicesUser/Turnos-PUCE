<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TurneroController extends Controller
{
    public function vista(){
        return view('turnero');
    }

    public function tiemporeal(){
        $toca   =   DB::select("SELECT turnos.id_tu,nu_tu,inicio_tu,fin_tu,estudiantes.cedula_es,nombres_es,apellidos_es,email_es,detalle_cu FROM turnos natural join horarios natural join dias natural join users natural join estudiantes natural join  cubiculos where fecha_di=CURDATE() and id_et=1 order by inicio_tu");
        $paso   =   DB::select("SELECT turnos.id_tu,nu_tu,inicio_tu,fin_tu,estudiantes.cedula_es,nombres_es,apellidos_es,email_es,detalle_cu FROM turnos natural join horarios natural join dias natural join users natural join estudiantes natural join  cubiculos where fecha_di=CURDATE() and id_et!=1 order by inicio_tu limit 6");
        return (['toca'=>$toca,'paso'=>$paso]);
    }
}