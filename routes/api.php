<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('turnos','HorariosController@disponibles');
Route::get('tipos','ConsultaApiController@tipos');
Route::post('estudiantes','EstudianteController@consultar');
Route::patch('estudiantes','EstudianteController@actualizar');
Route::delete('estudiantes','EstudianteController@turno');
Route::options('estudiantes','EstudianteController@verificar');
Route::put('estudiantes','EstudianteController@eliminarTurno');
Route::post('publico','EstudianteController@consultarPublico');

Route::get('realtime','TurneroController@tiemporeal');