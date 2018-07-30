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
});

Auth::routes();

Route::middleware(['auth'])->group(function (){
    Route::get('/inicio', 'HomeController@index')->name('home');
    Route::get('/turnos/horario', 'HomeController@horarios')->name('turnos.horarios');
    Route::get('/turnos/citas', 'HomeController@citas')->name('turnos.citas');

    Route::prefix('app')->group(function () {
        Route::get('basic','HomeController@main');
    });
});


