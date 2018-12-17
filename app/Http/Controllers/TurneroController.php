<?php

namespace App\Http\Controllers;

use App\Cubiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class TurneroController extends Controller
{
    public function vista(){
        return view('turnero');
    }

    public function vista2(){
        return view('turnero2');
    }

    public function modulos(){
        return Cubiculo::all();
    }


    public function tiemporeal(){
        $fecha  =   Date::now()->format('Y-m-d H:i:s');
        $fecha2 =   Date::now()->format('Y-m-d H:')."00:00";
        $toca   =   DB::select("SELECT turnos.id_tu,nu_tu,turnos.id_et,inicio_tu,fin_tu,estudiantes.cedula_es,nombres_es,apellidos_es,email_es,detalle_cu,fecha_tu,nombre_et FROM turnos natural join horarios natural join users natural join estudiantes natural join  cubiculos natural join estado_turno where DATE_FORMAT(CONCAT(fecha_tu,' ',inicio_tu), '%Y-%m-%d %H:%i:%s')>=DATE_FORMAT('$fecha','%Y-%m-%d %H:%i:%s') and id_et=2 and fecha_tu=DATE('$fecha') order by inicio_tu,detalle_cu ASC limit 12");
        $paso   =   DB::select("SELECT turnos.id_tu,nu_tu,turnos.id_et,inicio_tu,fin_tu,estudiantes.cedula_es,nombres_es,apellidos_es,email_es,detalle_cu,fecha_tu,nombre_et FROM turnos natural join horarios natural join users natural join estudiantes natural join  cubiculos natural join estado_turno where DATE_FORMAT(CONCAT(fecha_tu,' ',fin_tu), '%Y-%m-%d %H:%i:%s')>=DATE_FORMAT('$fecha2','%Y-%m-%d %H:%i:%s') and id_et>2 and fecha_tu=DATE('$fecha') order by inicio_tu,detalle_cu ASC limit 12");
        return (['toca'=>$toca,'paso'=>$paso]);
    }

    public function tiempoPuesto(Request $datos){
        $validator = Validator::make($datos->all(), [
            'fecha' =>  'required|date',
            'desde' =>  'required|numeric',
            'hasta' =>  'required|numeric|gt:desde',
            'modulo'=>  'required'
        ]);
        if ($validator->fails()) {
            $linea = '';
            foreach ($validator->errors()->all() as $item) {
                $linea .= "$item</br>";
            }
            return (['val'=>false,'mensaje'=>$linea,'errores'=>$validator->errors()]);
        }else{
            $fecha  =   Date::createFromFormat('Y-m-d H:i:s',$datos->fecha." ".$datos->desde.":00:00");
            $fecha2 =   Date::createFromFormat('Y-m-d H:i:s',$datos->fecha." ".$datos->hasta.":00:00");
            $cubiculo=$datos->modulo;
            $toca   =   DB::select("SELECT turnos.id_tu,nu_tu,turnos.id_et,inicio_tu,fin_tu,estudiantes.cedula_es,nombres_es,apellidos_es,email_es,detalle_cu,fecha_tu,nombre_et FROM turnos natural join horarios natural join users natural join estudiantes natural join  cubiculos natural join estado_turno where DATE_FORMAT(CONCAT(fecha_tu,' ',inicio_tu), '%Y-%m-%d %H:%i:%s')>=DATE_FORMAT('$fecha','%Y-%m-%d %H:%i:%s') and id_et=2 and fecha_tu=DATE('$fecha') and cubiculos.id_cu=$cubiculo order by inicio_tu,detalle_cu ASC ");
            $paso   =   DB::select("SELECT turnos.id_tu,nu_tu,turnos.id_et,inicio_tu,fin_tu,estudiantes.cedula_es,nombres_es,apellidos_es,email_es,detalle_cu,fecha_tu,nombre_et FROM turnos natural join horarios natural join users natural join  cubiculos natural join estado_turno left join estudiantes on estudiantes.cedula_es=turnos.cedula_es where DATE_FORMAT(CONCAT(fecha_tu,' ',fin_tu), '%Y-%m-%d %H:%i:%s')<=DATE_FORMAT('$fecha2','%Y-%m-%d %H:%i:%s') and id_et!=2 and fecha_tu=DATE('$fecha') and cubiculos.id_cu=$cubiculo order by inicio_tu,detalle_cu ASC");
            return (['val'=>true,'toca'=>$toca,'paso'=>$paso,'desde'=>$fecha,'hasta'=>$fecha2]);
        }
    }

    public function disponibles(){
        $toca   =   DB::select("SELECT turnos.id_tu,nu_tu,turnos.id_et,inicio_tu,fin_tu,detalle_cu,fecha_tu,nombre_et FROM turnos natural join horarios natural join users natural join  cubiculos natural join estado_turno where turnos.id_et=1 order by fecha_tu,inicio_tu ");
        return view('disponibles',['disponibles'=>$toca]);
    }
}
