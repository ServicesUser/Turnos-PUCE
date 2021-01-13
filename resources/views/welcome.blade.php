@extends('template.estudiante')
@section('titulo') Reservación @endsection
@section('cuerpo')
    @if (env('PUBLICO'))
        <publico
                paso4="{{ (int)config('app.paso') }}"
        />
    @else
        <estudiante
                paso4="{{ (int)config('app.paso') }}"
        />
    @endif
@endsection