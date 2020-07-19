@extends('template.app')
@section('titulo')Estudiantes @endsection
@section('cuerpo')
    <div class="row">
        <div class="col-md-6 col-12">
            <nuevo-estudiante></nuevo-estudiante>
        </div>
        <div class="col-md-6 col-12">
            <turnos-estudiante></turnos-estudiante>
        </div>
    </div>
@endsection