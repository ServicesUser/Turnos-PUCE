<?php

namespace App\Http\Controllers;

use App\Events\ActualizarTurnero;
use App\Horario;
use App\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;

class CitasController extends Controller
{
    public function cola(){
        $usuario    =   Auth::user()->id;
        $pendientes =   DB::select("SELECT turnos.id_tu,inicio_tu,fin_tu,estudiantes.cedula_es,nombres_es,apellidos_es,email_es FROM turnos natural join horarios natural join dias natural join users natural join estudiantes where fecha_di=CURDATE() and id_et=2 and users.id=$usuario order by inicio_tu");
        $completos  =   DB::select("SELECT turnos.id_tu,inicio_tu,fin_tu,estudiantes.cedula_es,nombres_es,apellidos_es,email_es FROM turnos natural join horarios natural join dias natural join users natural join estudiantes where fecha_di=CURDATE() and id_et=3 and users.id=$usuario order by inicio_tu");

        return ([
            'pendeientes'   =>  count($pendientes),
            'completos'     =>  count($completos),
            'lista'         =>  collect($pendientes)->take(7),
        ]);
    }

    public function cambiarEstado(Request $datos){
        $turno              =   Turno::find($datos->id);
        if($turno){
            $turno->id_et   =   $datos->estado;
            $turno->id_us   =   Auth::user()->id;
            $turno->save();
            event(new ActualizarTurnero($turno));
            return (['val' => true,'mensaje'=>'Se a guardado correctamente']);
        }
        return (['val' => false,'mensaje'=>'Ha ocurrido un error vuelva a cargar la página']);
    }

}
