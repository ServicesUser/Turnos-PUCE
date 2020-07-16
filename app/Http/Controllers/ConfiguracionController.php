<?php

namespace App\Http\Controllers;

use App\Cubiculo;
use App\Turno;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ConfiguracionController extends Controller
{
    public function index (){
        return view("configuracion");
    }

    public function contrasena (Request $datos){
        $validacion = Validator::make($datos->all(), [
            'password'  =>  'required'
        ]);
        if ($validacion->fails()) {
            $mensaje="";
            foreach ($validacion->errors()->all() as $item)
                $mensaje.="$item</br>";
            return (['val'=>false,'mensaje'=>$mensaje,'errores'=>$validacion->errors()->all()]);
        }else{
            $usuario            =   User::find(Auth::user()->id);
            $usuario->password  =   bcrypt($datos->password);
            $usuario->save();
            return (['val'=>true,'mensaje'=>"Contraseña Actualizada"]);
        }
    }

    public function parametros (Request $datos){
        $validacion = Validator::make($datos->all(), [
            'zoom'    =>  'required|url',
        ]);
        if ($validacion->fails()) {
            $mensaje="";
            foreach ($validacion->errors()->all() as $item)
                $mensaje.="$item</br>";
            return (['val'=>false,'mensaje'=>$mensaje,'errores'=>$validacion->errors()->all()]);
        }else{
            $cubiculo           =   Cubiculo::find(Auth::user()->id_cu);
            $cubiculo->link_cu  =   $datos->zoom;
            $cubiculo->save();
            return (['val'=>true,'mensaje'=>"Parámetros Actualizados"]);
        }
    }

    public function loadParametros (){
        return Cubiculo::find(Auth::user()->id_cu);
    }
}
