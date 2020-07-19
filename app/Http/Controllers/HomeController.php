<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('home');
    }

    public function horarios(){
        return view('horario');
    }

    public function citas(){
        return view('citas');
    }

    public function main(){
        return ([
            'user'              =>  Auth::user(),
            'notificaciones'    =>  $this->notifiaciones(),
            'logout'            =>  route('logout'),
            'menu'              =>  [
                'historial' =>  route('home'),
                'horarios'  =>  route('turnos.horarios'),
                'citas'     =>  route('turnos.citas'),
                'estudiante'=>  route('estudiantes'),
            ],
        ]);
    }

    private function notifiaciones(){
        $user=Auth::user();
        setlocale(LC_TIME, auth()->user()->locale);
        $aux=[];
        foreach ($user->unreadNotifications->take(10) as $item){
            $a['mensaje']   =   @$item->data['mensaje'];
            $a['url']       =   @$item->data['url'];
            $a['fecha']     =   Date::createFromFormat('Y-m-d H:i:s',$item->data['fecha'])->diffForHumans();
            $aux[]          =   $a;
        }
        return array_reverse($aux);
    }
}
