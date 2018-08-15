<?php

namespace App\Http\Controllers;

use App\Estudiante;
use Illuminate\Http\Request;
use Unirest\Request as Consulta;

class ConsultaApiController extends Controller
{
    private function intranet($dni){
        $url=env('PUCE_API');
        $response = Consulta::get("$url/$dni",
            [
                "Accept" => "application/rest"
            ]
        );
        $cabecera=$response->headers;
        if(@$cabecera['Content-Type'][1]==='application/json')//varia a veces
            return collect($response->body);
        else
            return false;
    }

    public function guardar($cedula){
        $valor  =   $this->intranet($cedula);
        $nuevo  =   null;
        if($valor){
            $nuevo              =   new Estudiante();
            $nuevo->cedula_es   =   $valor->first()->cedula;
            $nuevo->nombres_es  =   $valor->first()->nombre;
            $nuevo->celular_es  =   $valor->first()->celular;
            $nuevo->telefono_es =   $valor->first()->telefono;
            $nuevo->save();
            $nuevo              =   collect($nuevo)->put('turno', null);
        }
        return $nuevo;
    }
}
