@extends('template.estudiante')
@section('titulo') Turnos disponibles @endsection
@section('cuerpo')
    <div class="row">
        <div class="list-group">
            @foreach ($disponibles as $item)
                <a href="javascript:;" class="list-group-item">
                    <h4 class="list-group-item-heading"><b>{{$item->inicio_tu}} {{$item->fecha_tu}} {{$item->detalle_cu}}</b></h4>
                </a>
            @endforeach
        </div>
    </div>
@endsection