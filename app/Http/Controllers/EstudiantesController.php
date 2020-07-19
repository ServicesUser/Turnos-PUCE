<?php

namespace App\Http\Controllers;

use App\Estudiante;
use App\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EstudiantesController extends Controller
{
    protected $registro;

    public function __construct(HistorialController $registro)
    {
        $this->registro = $registro;
    }

    public function index()
    {
        return view('estudiante');
    }

    public function nuevo(Request $datos)
    {
        $validacion = Validator::make($datos->all(), [
            'identificacion' => 'unique:estudiantes,cedula_es|required|max:10',
            'correo' => 'nullable|email',
            'nombre' => 'required|string',
            'celular' => 'nullable|size:10',
            'telefono' => 'nullable|size:9',
        ]);
        if ($validacion->fails()) {
            $mensaje = "";
            foreach ($validacion->errors()->all() as $item)
                $mensaje .= "$item</br>";
            return (['val' => false, 'mensaje' => $mensaje, 'errores' => $validacion->errors()->all()]);
        } else {
            $nuevo = new Estudiante();
            $nuevo->cedula_es = $datos->identificacion;
            $nuevo->email_es = $datos->correo;
            $nuevo->nombres_es = $datos->nombre;
            $nuevo->celular_es = $datos->celular;
            $nuevo->telefono_es = $datos->telefono;
            $nuevo->save();
            $cubiculo = @Auth::user()->name;
            $this->registro->logTxt("$cubiculo registró al estudiante $nuevo->cedula_es");
            return (['val' => true, 'mensaje' => "Se ha registrado $nuevo->cedula_es correctamente"]);
        }

    }

    public function turnos(Request $datos)
    {
        $validacion = Validator::make($datos->all(), [
            'identificacion' => 'exists:estudiantes,cedula_es|required',
        ]);
        if ($validacion->fails()) {
            $mensaje = "";
            foreach ($validacion->errors()->all() as $item)
                $mensaje .= "$item</br>";
            return (['val' => false, 'mensaje' => $mensaje, 'errores' => $validacion->errors()->all()]);
        } else {
            $lista = Turno::where('cedula_es', $datos->identificacion)->with('estado', 'horario')->get();
            return $lista;
        }

    }


}
