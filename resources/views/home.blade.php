@extends('template.app')
@section('titulo')Inicio @endsection
@section('cuerpo')
    <div class="row">
        <div class="portlet light bordered">
            <div class="portlet-title tabbable-line">
                <div class="caption">
                    <i class="icon-globe font-dark"></i>
                    <span class="caption-subject font-dark bold uppercase">Feeds</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1_1">
                        <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                            <feed></feed>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection