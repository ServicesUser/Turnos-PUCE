@extends('template.invitado')
@section('titulo') Recuperar cuenta @endsection
@section('cuerpo')
    <div class="m-grid m-grid--hor m-grid--root m-page" id="invitado">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin">
            <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
                <div class="m-stack m-stack--hor m-stack--desktop">
                    <div class="m-stack__item m-stack__item--fluid">
                        <div class="m-login__wrapper">
                            @component('componentes.invitado.form_logo')
                            @endcomponent
                            <div class="m-login__signin">
                                @component('componentes.invitado.form_titulo')
                                    @slot('titulo', 'Olvidó su contraseña')
                                    @slot('estado', 'Ingrese su correo electrónico')
                                @endcomponent
                                @component('componentes.invitado.form_email')
                                @endcomponent
                            </div>
                        </div>
                    </div>
                    @component('componentes.invitado.registro')
                    @endcomponent
                </div>
            </div>
            @component('componentes.invitado.login_panel')
            @endcomponent
        </div>
    </div>
@endsection