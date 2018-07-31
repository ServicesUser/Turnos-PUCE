<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;

class TurneroController extends Controller
{
    public function vista(){
        return view('turnero');
    }

    public function tiemporeal(){
        $fecha  =   Date::now()->format('Y-m-d H:i:s');
        $toca   =   DB::select("SELECT turnos.id_tu,nu_tu,inicio_tu,fin_tu,estudiantes.cedula_es,nombres_es,apellidos_es,email_es,detalle_cu,fecha_tu,nombre_et FROM turnos natural join horarios natural join users natural join estudiantes natural join  cubiculos natural join estado_turno where DATE_FORMAT(CONCAT(fecha_tu,' ',inicio_tu), '%Y-%m-%d %H:%i:%s')>=DATE_FORMAT('$fecha','%Y-%m-%d %H:%i:%s') and id_et=2 and fecha_tu=DATE('$fecha') order by inicio_tu limit 15");
        $paso   =   DB::select("SELECT turnos.id_tu,nu_tu,inicio_tu,fin_tu,estudiantes.cedula_es,nombres_es,apellidos_es,email_es,detalle_cu,fecha_tu,nombre_et FROM turnos natural join horarios natural join users natural join estudiantes natural join  cubiculos natural join estado_turno where DATE_FORMAT(CONCAT(fecha_tu,' ',fin_tu), '%Y-%m-%d %H:%i:%s')>=DATE_FORMAT('$fecha','%Y-%m-%d %H:%i:%s') and id_et>2 and fecha_tu=DATE('$fecha') order by inicio_tu limit 6");
        return (['toca'=>$toca,'paso'=>$paso]);
    }
}
