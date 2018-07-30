@extends('template.app')
@section('titulo')Horario @endsection
@section('cuerpo')
    <div class="row">
        <div class="col-md-6">
            <nuevo-horario></nuevo-horario>
        </div>
        <div class="col-md-6">
            <horarios></horarios>
        </div>
    </div>
@endsection