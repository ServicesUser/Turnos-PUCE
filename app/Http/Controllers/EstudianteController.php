<?php

namespace App\Http\Controllers;

use App\Estudiante;
use App\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EstudianteController extends Controller
{
    public function consultar(Request $datos){
        return Estudiante::find($datos->dni);
    }

    public function actualizar(Request $datos){
        $validacion = Validator::make($datos->all(), [
            'email'                 =>  'required|email',
            'estudiante.cedula_es'  =>  'exists:estudiantes,cedula_es'
        ]);
        if ($validacion->fails()) {
            $mensaje="";
            foreach ($validacion->errors()->all() as $item)
                $mensaje.="$item</br>";
            return (['val'=>false,'mensaje'=>$mensaje,'errores'=>$validacion->errors()->all()]);
        }else{
            $a                      =   json_decode ($datos->estudiante);
            $aux                    =   Estudiante::where('cedula_es',$a->cedula_es)->first();
            $aux->email_es          =   $datos->email;
            $aux->validado_es       =   true;
            $aux->save();
            return (['val'=>true,'mensaje'=>"Se ha actualizado su correo electrónico"]);
        }
    }

    public function turno(Request $datos){
        $validacion = Validator::make($datos->all(), [
            'estudiante.cedula_es'  =>  'exists:estudiantes,cedula_es',
            'fecha'                 =>  'required|date',
            'turno'                 =>  'required'
        ]);
        if ($validacion->fails()) {
            $mensaje="";
            foreach ($validacion->errors()->all() as $item)
                $mensaje.="$item</br>";
            return (['val'=>false,'mensaje'=>$mensaje,'errores'=>$validacion->errors()->all()]);
        }else{
            $a                      =   json_decode ($datos->estudiante);
            $estudiante             =   Estudiante::find($a->cedula_es);

            $a                      =   json_decode ($datos->turno);
            $turno                  =   Turno::where(DB::raw('DATE_FORMAT(fecha_tu, "%d-%m-%Y")'),$a->fecha)->where('inicio_tu',$a->inicio)->where('fin_tu',$a->fin)->where('id_et',1)->first();

            $tiene                  =   Turno::where('cedula_es', $estudiante->cedula_es)->first();
            if($tiene)
                return (['val'=>false,'mensaje'=>"Ya tiene un turno asignado, refresque la página"]);
            if($turno){
                $turno->cedula_es   =   $estudiante->cedula_es;
                $turno->id_et       =   2;
                $turno->save();
                return (['val'=>true,'mensaje'=>"Se le ha asignado un turno, se envió un correo electrónico a $estudiante->email_es  con la información"]);
            }else{
                return (['val'=>false,'mensaje'=>"No existe cupos disponibles para la fecha seleccionada"]);
            }
        }
    }

    public function verificar(Request $datos){
        $validacion = Validator::make($datos->all(), [
            'estudiante.cedula_es'  =>  'exists:estudiantes,cedula_es',
        ]);
        if ($validacion->fails()) {
            $mensaje="";
            foreach ($validacion->errors()->all() as $item)
                $mensaje.="$item</br>";
            return (['val'=>false,'mensaje'=>$mensaje,'errores'=>$validacion->errors()->all()]);
        }else{
            $a                      =   json_decode ($datos->estudiante);
            $estudiante             =   Estudiante::find($a->cedula_es);

            $tiene                  =   Turno::with('horario')->with('antendio')->where('cedula_es', $estudiante->cedula_es)->first();
            return $tiene;
        }
    }
}
