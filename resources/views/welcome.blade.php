@extends('template.estudiante')
@section('titulo') Reservación @endsection
@section('cuerpo')
    @if (env('PUBLICO'))
        <publico></publico>
    @else
        <estudiante></estudiante>
    @endif
@endsection