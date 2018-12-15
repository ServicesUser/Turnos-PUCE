<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('turno');

Auth::routes();

Route::middleware(['auth'])->group(function (){
    Route::get('/inicio', 'HomeController@index')->name('home');

    Route::prefix('/turnos/horario')->group(function () {
        Route::get('/', 'HomeController@horarios')->name('turnos.horarios');
        Route::options('/','HorariosController@misHorarios');
        Route::post('/','HorariosController@nuevoHorario');
    });

    Route::prefix('/turnos/citas')->group(function () {
        Route::get('/', 'HomeController@citas')->name('turnos.citas');
        Route::options('/','CitasController@cola');
        Route::post('/','CitasController@cambiarEstado');
    });


    Route::prefix('app')->group(function () {
        Route::get('basic','HomeController@main');
    });
});

Route::get('cola','TurneroController@vista');
Route::get('cola2','TurneroController@vista2');
Route::post('cola2','TurneroController@tiempoPuesto');
Route::get('disponibles','TurneroController@disponibles');

