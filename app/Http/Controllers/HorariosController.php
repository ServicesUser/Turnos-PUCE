<?php

namespace App\Http\Controllers;

use App\Dia;
use App\Horario;
use App\Trabajo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class HorariosController extends Controller{

    public function misHorarios(){
        $lista  =   Trabajo::where('id',Auth::user()->id)->with('horario')->latest('creado_ht')->limit(20)->get();
        $aux    =   [];
        foreach ($lista as $item){
            $a['texto']     =   Date::createFromFormat('Y-m-d', $item->horario['dia']['fecha_di'])->format('l, d F Y').' de '.$item->horario['inicio_ho'].' a '.$item->horario['fin_ho'];
            $a['fecha1']    =   $item->creado_ht;
            $a['fecha2']    =   Date::createFromFormat('Y-m-d H:i:s',$item->creado_ht)->diffForHumans();
            $aux[]          =   $a;
        }
        return $aux;
    }

    public function nuevoHorario(Request $datos){
        $validacion = Validator::make($datos->all(), [
            'fecha'     =>  'required|date',
            'inicio'    =>  'required|date_format:"H:i"',
            'fin'       =>  'required|date_format:"H:i"|after:inicio',
        ]);
        if ($validacion->fails()) {
            $mensaje="";
            foreach ($validacion->errors()->all() as $item)
                $mensaje.="$item</br>";
            return (['val'=>false,'mensaje'=>$mensaje,'errores'=>$validacion->errors()->all()]);
        }else{
            DB::beginTransaction();
            try {
                //dia
                $dias   =   Dia::where('fecha_di',$datos->fecha)->first();
                if(!$dias){
                    $dias           =   new Dia();
                    $dias->id_di    =   hash('joaat',$datos->fecha);
                    $dias->fecha_di =   $datos->fecha;
                    $dias->save();
                }
                //horario
                $horario    =   Horario::where('inicio_ho',$datos->inicio)->where('fin_ho',$datos->fin)->where('id_di',$dias->id_di)->first();
                if(!$horario){
                    $horario            =   new Horario();
                    $horario->id_ho     =   hash('joaat',$datos->inicio.$datos->fin);
                    $horario->id_di     =   $dias->id_di;
                    $horario->inicio_ho =   $datos->inicio;
                    $horario->fin_ho    =   $datos->fin;
                    $horario->save();
                }

                //horario de atencion
                $trabajo    =   Trabajo::where('id',Auth::user()->id)->where('id_ho',$horario->id_ho)->first();
                if($trabajo){
                    return (['val' => false,'mensaje'=>'Ya existe un horario de anteción registrado']);
                }else{
                    $trabajo        =   new Trabajo();
                    $trabajo->id_ho =   $horario->id_ho;
                    $trabajo->id    =   Auth::user()->id;
                    $trabajo->save();
                    DB::commit();
                    return (['val' => true,'mensaje'=>'Se ha registrado su Horario de Atención']);
                }
            } catch (\Exception $e) {
                DB::rollback();
                return (['val' => false, 'mensaje' => $e->getMessage()]);
            }
        }
    }
}
