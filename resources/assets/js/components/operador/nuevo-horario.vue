<template>
    <div class="portlet light bordered">
        <div class="portlet-title tabbable-line">
            <div class="caption">
                <i class="icon-globe font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase">Nuevo horario de atención</span>
            </div>
        </div>
        <div class="portlet-body from">
            <form action="#" class="form-horizontal form-bordered">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Día</label>
                        <div class="col-md-9">
                            <div class="input-icon right">
                                <i class="fa fa-calendar"></i>
                                <input type="text" size="16" class="form-control" id="fecha">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Inicio de jornada</label>
                        <div class="col-md-9">
                            <div class="input-icon right" >
                                <i class="fa fa-clock-o"></i>
                                <input type="text" size="5" class="form-control timepicker timepicker-24" id="inicio" value="7:00">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Fin de jornada</label>
                        <div class="col-md-9">
                            <div class="input-icon right" >
                                <i class="fa fa-clock-o"></i>
                                <input type="text" size="5" class="form-control timepicker timepicker-24" id="fin" value="17:00"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="col-md-offset-3">
                        <button type="submit" class="btn blue">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "nuevo-horario",
        data: () => ({
            fecha:'',
            inicio:'8:00',
            fin:'17:00',
        }),
        mounted(){
            let vm=this;
            $('#fecha').daterangepicker({
                "singleDatePicker": true,
                "showCustomRangeLabel": false,
                "opens": "center"
            }, function(start, end, label) {
                vm.fecha=start.format('YYYY-MM-DD');
            });
            $('.timepicker-24').timepicker({
                autoclose: true,
                minuteStep: 15,
                showSeconds: false,
                showMeridian: false
            });
            $('#inicio').timepicker().on('changeTime.timepicker', function(e) {
                vm.inicio=e.time.value;
            });
            $('#fin').timepicker().on('changeTime.timepicker', function(e) {
                vm.fin=e.time.value;
            });
        }
    }
</script>

<style scoped>

</style>