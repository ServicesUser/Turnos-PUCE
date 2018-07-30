<?php

namespace App\Http\Controllers;

use App\Trabajo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HorariosController extends Controller{

    public function misHorarios(){
        return Trabajo::where('id',Auth::user()->id)->latest('creado_ht')->limit(20)->get();
    }
}
