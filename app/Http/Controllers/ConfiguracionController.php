<?php

namespace App\Http\Controllers;

use App\Cubiculo;
use App\Historia;
use App\Turno;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class ConfiguracionController extends Controller
{
    public function index()
    {
        return view("configuracion");
    }

    public function contrasena(Request $datos)
    {
        $validacion = Validator::make($datos->all(), [
            'password' => 'required'
        ]);
        if ($validacion->fails()) {
            $mensaje = "";
            foreach ($validacion->errors()->all() as $item)
                $mensaje .= "$item</br>";
            return (['val' => false, 'mensaje' => $mensaje, 'errores' => $validacion->errors()->all()]);
        } else {
            $usuario = User::find(Auth::user()->id);
            $usuario->password = bcrypt($datos->password);
            $usuario->save();
            return (['val' => true, 'mensaje' => "Contraseña Actualizada"]);
        }
    }

    public function parametros(Request $datos)
    {
        $validacion = Validator::make($datos->all(), [
            'zoom' => 'required|url',
        ]);
        if ($validacion->fails()) {
            $mensaje = "";
            foreach ($validacion->errors()->all() as $item)
                $mensaje .= "$item</br>";
            return (['val' => false, 'mensaje' => $mensaje, 'errores' => $validacion->errors()->all()]);
        } else {
            $cubiculo = Cubiculo::find(Auth::user()->id_cu);
            $cubiculo->link_cu = $datos->zoom;
            $cubiculo->save();
            return (['val' => true, 'mensaje' => "Parámetros Actualizados"]);
        }
    }

    public function consultaTurnos()
    {
        $fecha  =   Date::now()->format('Y-m-d H:i:s');
        $usuario    =   Auth::user()->id;
        $lista      =   DB::select("SELECT * FROM horarios natural join turnos WHERE horarios.id=$usuario AND DATE_FORMAT(CONCAT(fecha_tu,' ',inicio_tu), '%Y-%m-%d %H:%i:%s')>=DATE_FORMAT('$fecha','%Y-%m-%d %H:%i:%s') ORDER BY fecha_tu,inicio_tu");
        return (['val' => true, 'data' => $lista]);
    }

    public function eliminarTurnos(Request $datos)
    {
        $validacion = Validator::make($datos->all(), [
            'turnos' => 'required|array',
            'turnos.*' => 'required|exists:turnos,id_tu',
        ]);
        if ($validacion->fails()) {
            $mensaje = "";
            foreach ($validacion->errors()->all() as $item)
                $mensaje .= "$item</br>";
            return (['val' => false, 'mensaje' => $mensaje, 'errores' => $validacion->errors()->all()]);
        } else {
            $usuario    =   Auth::user()->id;
            foreach ($datos->turnos as $item){
                $turno = Turno::find($item);
                Historia::where('id_tu',$turno->id_tu)->update(['id_tu' => null]);
                $log = new Historia();
                $log->id = $usuario;
                $log->detalle_ht = "Ha eliminado el turno $item del $turno->fecha_tu  $turno->inicio_tu";
                $log->save();
                $turno->delete();
            }

            return (['val' => true, 'mensaje' => "Eliminados"]);
        }
    }

    public function loadParametros()
    {
        return Cubiculo::find(Auth::user()->id_cu);
    }
}
