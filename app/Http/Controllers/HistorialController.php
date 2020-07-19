<?php

namespace App\Http\Controllers;

use App\Estado;
use App\Historia;
use App\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HistorialController extends Controller
{
    public function log(Turno $turno, $estadoId=null, $log=null)
    {
        $dia    =   $turno->inicio_tu."-".$turno->fin_tu." ".$turno->fecha_tu;
        $id     =   null;
        if($estadoId){
            $estadoN = Estado::find($estadoId);
        }
        if(@Auth::id()){
            $id = Auth::user()->id;
            if($estadoId)
                $cadena = Auth::user()->name." cambió de estado $dia a $estadoN->nombre_et";
            else
                $cadena = Auth::user()->name." creó $dia";
        }else{
            $id = $turno->horario->id;
            if($estadoId===1)
                $cadena = (string)$turno->estudiante->nombres_es." ".$turno->estudiante->apellidos_es." desistió de el turno  $dia";
            else
                $cadena = (string)$turno->estudiante->nombres_es." ".$turno->estudiante->apellidos_es." tomó el turno  $dia";
        }
        $nuevo = new Historia();
        $nuevo->id_tu = $turno->id_tu;
        $nuevo->id_et = $estadoId;
        $nuevo->id = $id;
        $nuevo->detalle_ht = $log ? (string)$log : (string)$cadena;
        $nuevo->save();
    }

    public function logTxt($log=null)
    {
        $nuevo = new Historia();
        $nuevo->id = @Auth::user()->id;
        $nuevo->detalle_ht = (string)$log;
        $nuevo->save();
    }
}
