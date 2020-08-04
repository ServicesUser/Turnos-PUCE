@extends('template.app')
@section('titulo')Agenda @endsection
@section('cuerpo')
    <div class="row">
        <citas ide="{{Auth::user()->id}}"></citas>
    </div>
@endsection
