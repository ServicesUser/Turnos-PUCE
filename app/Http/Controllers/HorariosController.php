<?php

namespace App\Http\Controllers;

use App\Dia;
use App\Horario;
use App\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class HorariosController extends Controller{

    protected $registro;

    public function __construct(HistorialController $registro)
    {
        $this->registro     =   $registro;
    }

    public function misHorarios(){
        $lista  =   Horario::where('id',Auth::user()->id)->latest('creado_ho')->limit(20)->get();
        $aux    =   [];
        foreach ($lista as $item){
            $a['texto']     =   Date::createFromFormat('Y-m-d', $item->dia['fecha_di'])->format('l, d F Y').' de '.$item->inicio_ho.' a '.$item->fin_ho;
            $a['fecha1']    =   $item->creado_ho;
            $a['fecha2']    =   Date::createFromFormat('Y-m-d H:i:s',$item->creado_ho)->diffForHumans();
            $aux[]          =   $a;
        }
        return $aux;
    }

    public function nuevoHorario(Request $datos){
        $validacion = Validator::make($datos->all(), [
            'fecha'     =>  'required|date',
            'inicio'    =>  'required',
            'fin'       =>  'required|after:inicio',
        ]);
        if ($validacion->fails()) {
            $mensaje="";
            foreach ($validacion->errors()->all() as $item)
                $mensaje.="$item</br>";
            return (['val'=>false,'mensaje'=>$mensaje,'errores'=>$validacion->errors()->all()]);
        }else{
            $duracion   =   env('PROMEDIO')+env('ESPERA');
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
                $horario    =   Horario::where('inicio_ho',$datos->inicio)->where('fin_ho',$datos->fin)->where('id_di',$dias->id_di)->where('id',Auth::user()->id)->first();
                if(!$horario){
                    $horario            =   new Horario();
                    $horario->id_ho     =   hash('joaat',$datos->inicio.$datos->fin.$dias->id_di.'-'.Auth::user()->id);
                    $horario->id        =   Auth::user()->id;
                    $horario->id_di     =   $dias->id_di;
                    $horario->inicio_ho =   $datos->inicio;
                    $horario->fin_ho    =   $datos->fin;
                    $horario->save();


                    $fInicio        =   Date::createFromFormat('Y-m-d H:i',$dias->fecha_di.' '.$horario->inicio_ho);
                    $fFin           =   Date::createFromFormat('Y-m-d H:i',$dias->fecha_di.' '.$horario->fin_ho);
                    $generado       =   0;
                    while($fInicio<$fFin){
                        $turno              =   new Turno();
                        $turno->id_tu       =   md5($dias->fecha_di.$fInicio->format('H:i:s')."-".Auth::user()->id);
                        $turno->id_et       =   1;
                        $turno->id_ho       =   $horario->id_ho;
                        $turno->inicio_tu   =   $fInicio->format('H:i:s');
                        $turno->nu_tu       =   Turno::where('fecha_tu',$dias->fecha_di)->count()+1;
                        $fInicio->add("$duracion minute");
                        $turno->fin_tu      =   $fInicio->format('H:i:s');
                        $turno->fecha_tu    =   $dias->fecha_di;
                        if($fInicio<=$fFin){
                            $turno->save();
                            $this->registro->log($turno);
                            $generado++;
                        }
                    }
                    DB::commit();
                    return (['val' => true,'mensaje'=>'Se ha generado '.$generado.' turnos']);
                }else{
                    return (['val' => false,'mensaje'=>'Ya tiene registrado este horario']);
                }
            } catch (\Exception $e) {
                DB::rollback();
                return (['val' => false, 'mensaje' => "Ya tiene un horario registrado con esos parámetros"]);
            }
        }
    }

    public function disponibles(Request $datos){

        $disponibles =  Turno::select(
            'cubiculos.detalle_cu',
            DB::raw('DATE_FORMAT(fecha_tu, "%d-%m-%Y") AS  fecha'),
            DB::raw('DATE_FORMAT(inicio_tu, "%H:%i") AS inicio'),
            DB::raw('DATE_FORMAT(inicio_tu, "%H:%i") AS title'),
            DB::raw('DATE_FORMAT(CONCAT(fecha_tu," ",inicio_tu), "%Y-%m-%d %H:%i") AS startDate '),
            DB::raw('DATE_FORMAT(CONCAT(fecha_tu," ",fin_tu), "%Y-%m-%d %H:%i") AS endDate '),
            DB::raw('DATE_FORMAT(fin_tu, "%H:%i") AS  fin'),
            DB::raw('DATE_FORMAT(CONCAT(fecha_tu," ",inicio_tu), "%Y/%m/%d %H:%i") AS date'),
            DB::raw('COUNT(id_tu) as cupos'),
            'horarios.id_ho as id'
        )
            ->leftJoin('horarios','horarios.id_ho','=','turnos.id_ho')
            ->leftJoin('users','users.id','=','horarios.id')
            ->leftJoin('cubiculos','cubiculos.id_cu','=','users.id_cu')

            ->where('id_et',1)
            ->where(
                DB::raw('DATE_FORMAT(CONCAT(fecha_tu," ",inicio_tu), "%Y-%m-%d %H:%i:%s")'),'>=',
                DB::raw('DATE_FORMAT("'.$datos -> fecha.'", "%Y-%m-%d %H:%i:%s")')

            )
            ->orderBy('fecha_tu','asc')
            ->orderBy('inicio_tu','asc')
            ->groupBy('fecha_tu','inicio_tu','fin_tu','cubiculos.id_cu','cubiculos.detalle_cu','horarios.id_ho')
            ->get();
        return $disponibles;

    }

}

