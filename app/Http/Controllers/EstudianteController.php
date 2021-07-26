<?php

namespace App\Http\Controllers;

use App\Estudiante;
use App\Events\ModuloUpdate;
use App\Events\Turno as Notificacion;
use App\Notifications\ConfirmacionTurno;
use App\Turno;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class EstudianteController extends Controller
{
    protected $registro;

    public function __construct(HistorialController $registro)
    {
        $this->registro = $registro;
    }

    public function consultar(Request $datos)
    {
        $fecha = Date::now()->format('Y-m-d');
        $estudainte = Estudiante::find($datos->dni);
        if (!$estudainte) {
            return app('App\Http\Controllers\ConsultaApiController')->guardar($datos->dni);
        } else {
            $turno = Turno::where('fecha_tu', '>=', $fecha)->where('cedula_es', $estudainte->cedula_es)->where('id_et', 2)->first();
            $estudainte = collect($estudainte)->put('turno', $turno);
            return $estudainte;
        }
    }

    public function consultarPublico(Request $datos)
    {
        $validacion = Validator::make($datos->all(), [
            'dni' => 'required|max:10',
            'nombres' => 'required',
        ]);
        if ($validacion->fails()) {
            $mensaje = "";
            foreach ($validacion->errors()->all() as $item)
                $mensaje .= "$item</br>";
            return (['val' => false, 'mensaje' => $mensaje, 'errores' => $validacion->errors()->all()]);
        } else {
            $estudiante = Estudiante::find($datos->dni);
            if (!$estudiante) {
                $estudiante = new Estudiante();
                $estudiante->cedula_es = $datos->dni;
                $estudiante->nombres_es = $datos->nombres;
                $estudiante->celular_es = $datos->celular;
                $estudiante->telefono_es = $datos->telefono;
                $estudiante->publico_es = true;
                $estudiante->save();
            } else {
                $estudiante->nombres_es = $datos->nombres;
                $estudiante->celular_es = $datos->celular ? $datos->celular  : $estudiante->celular_es;
                $estudiante->telefono_es = $datos->telefono? $datos->telefono : $estudiante->telefono_es;
                $estudiante->publico_es = true;
                $estudiante->save();
            }
            $turno = Turno::where('cedula_es', $estudiante->cedula_es)->where('id_et', 2)->first();
            $estudiante = collect($estudiante)->put('turno', $turno);
            return (['val' => true, 'mensaje' => 'Se creó', 'data' => $estudiante]);
        }
    }

    public function eliminarTurno(Request $datos)
    {
        $validacion = Validator::make($datos->all(), [
            'turno.id_tu'   => 'exists:turnos,id_tu'
        ]);
        if ($validacion->fails()) {
            $mensaje = "";
            foreach ($validacion->errors()->all() as $item)
                $mensaje .= "$item</br>";
            return (['val' => false, 'mensaje' => $mensaje, 'errores' => $validacion->errors()->all()]);
        } else {
            $aux = Turno::find($datos->turno['id_tu']);
            $this->registro->log($aux, 1);
            $aux->id_et = 1;
            $aux->id_ti = null;
            $aux->obs_tu= null;
            $aux->cedula_es = null;
            $aux->save();
            event(new ModuloUpdate($aux->horario->responsable));
            event(new Notificacion($aux));
            return (['val' => true, 'mensaje' => "Se ha eliminado tu reserva " . $aux->fecha_tu . " a las " . $aux->inicio_tu]);
        }
    }

    public function actualizar(Request $datos)
    {
        $validacion = Validator::make($datos->all(), [
            'email' => 'required|email',
            'estudiante.cedula_es' => 'exists:estudiantes,cedula_es',
            'estudiante.turno.id_tu' => 'exists:turnos,id_tu',
        ]);
        if ($validacion->fails()) {
            $mensaje = "";
            foreach ($validacion->errors()->all() as $item)
                $mensaje .= "$item</br>";
            return (['val' => false, 'mensaje' => $mensaje, 'errores' => $validacion->errors()->all()]);
        } else {
            $aux = Estudiante::find($datos->estudiante['cedula_es']);
            $aux->email_es = strtolower($datos->email);
            $aux->validado_es = true;
            $aux->save();
            return (['val' => true, 'mensaje' => "Se ha actualizado su correo electrónico"]);
        }
    }

    public function turno(Request $datos)
    {
        $validacion = Validator::make($datos->all(), [
            'estudiante.cedula_es' => 'exists:estudiantes,cedula_es',
            'turno.id' => 'exists:horarios,id_ho',
            'fecha' => 'required|date',
            'turno' => 'required',
            'tipo'          => 'nullable|exists:tipos,id_ti',
            'observacion'   => 'nullable'
        ]);
        if ($validacion->fails()) {
            $mensaje = "";
            foreach ($validacion->errors()->all() as $item)
                $mensaje .= "$item</br>";
            return (['val' => false, 'mensaje' => $mensaje, 'errores' => $validacion->errors()->all()]);
        } else {
            $dia = Carbon::now()->format('Y-m-d');
            $hora = Carbon::now()->format('H:i:s');

            $a = $datos->estudiante;
            $estudiante = Estudiante::find($a['cedula_es']);

            $a = $datos->turno;
            $turno = Turno::where(DB::raw('DATE_FORMAT(fecha_tu, "%d-%m-%Y")'), $a['fecha'])->where('inicio_tu', $a['inicio'])->where('fin_tu', $a['fin'])->where('id_ho',$a['id'])->where('id_et', 1)->first();

            $tiene = Turno::where('cedula_es', $estudiante->cedula_es)->where('id_et', 2)->whereDate('fecha_tu', '>=', $dia)->whereDate('inicio_tu', '>', $hora)->first();
            if ($tiene)
                return (['val' => false, 'mensaje' => "Ya tiene un turno asignado, refresque la página"]);
            if ($turno) {
                $turno->cedula_es = $estudiante->cedula_es;
                $turno->id_et = 2;
                $turno->id_ti = $datos->tipo;
                $turno->obs_tu= $datos->observacion;
                $turno->save();
                $this->registro->log($turno);
                event(new ModuloUpdate($turno->horario->responsable));
                event(new Notificacion($turno));
                return (['val' => true, 'mensaje' => "Se le ha asignado un turno, se envió un correo electrónico a $estudiante->email_es  con la información"]);
            } else {
                return (['val' => false, 'mensaje' => "No existe cupos disponibles para la fecha seleccionada"]);
            }
        }
    }

    public function verificar(Request $datos)
    {
        $validacion = Validator::make($datos->all(), [
            'estudiante.cedula_es' => 'exists:estudiantes,cedula_es',
        ]);
        if ($validacion->fails()) {
            $mensaje = "";
            foreach ($validacion->errors()->all() as $item)
                $mensaje .= "$item</br>";
            return (['val' => false, 'mensaje' => $mensaje, 'errores' => $validacion->errors()->all()]);
        } else {
            $estudiante = Estudiante::find($datos->estudiante['cedula_es']);
            $tiene = Turno::with('horario')->with('antendio')->where('cedula_es', $estudiante->cedula_es)->first();
            if ($tiene)
                Notification::send($estudiante, new ConfirmacionTurno($tiene));
            return $tiene;
        }
    }
}
