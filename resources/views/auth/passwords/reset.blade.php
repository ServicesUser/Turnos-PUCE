@extends('template.invitado')
@section('titulo') Restaurar Contraseña @endsection
@section('cuerpo')
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin">
            <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
                <div class="m-stack m-stack--hor m-stack--desktop">
                    <div class="m-stack__item m-stack__item--fluid">
                        <div class="m-login__wrapper">
                            @component('componentes.invitado.form_logo')
                            @endcomponent
                            <div class="m-login__signin">
                                @component('componentes.invitado.form_titulo')
                                    @slot('titulo', 'Recuperar contraseña')
                                    @slot('estado','Ingrese su nueva contraseña')
                                @endcomponent
                                @component('componentes.invitado.form_resetear')
                                    @slot('token',$token)
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @component('componentes.invitado.login_panel')
            @endcomponent
        </div>
    </div>
@endsection