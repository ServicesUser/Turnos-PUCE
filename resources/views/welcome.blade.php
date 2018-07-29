@extends('template.estudiante')
@section('titulo') Reservación @endsection
@section('cuerpo')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-body">
                    <form action="#" class="form-horizontal" novalidate="novalidate">
                        <div class="form-body">
                            <div class="alert alert-info">
                                 You have some form errors. Please check below.
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-3 control-label" for="form_control_1">Cédula/Pasaporte
                                    <span class="required" aria-required="true">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" placeholder="1700123456" name="email">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="portlet light portlet-fit portlet-form bordered">
            <div class="portlet-body">
                <est-cal></est-cal>
            </div>
        </div>
    </div>
@endsection