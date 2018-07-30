<template>
    <div class="portlet light bordered">
        <div class="portlet-title tabbable-line">
            <div class="caption">
                <i class="icon-globe font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase">Nuevo horario de atención</span>
            </div>
        </div>
        <div class="portlet-body from">
            <form action="#" class="form-horizontal form-bordered" v-on:submit.prevent="crearNuevo">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Día</label>
                        <div class="col-md-9">
                            <div class="input-icon right">
                                <i class="fa fa-calendar"></i>
                                <input type="text" size="16" class="form-control" id="fecha" name="dia" v-validate="'required'" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Inicio de jornada</label>
                        <div class="col-md-9">
                            <div class="input-icon right" >
                                <i class="fa fa-clock-o"></i>
                                <input type="text" size="5" class="form-control timepicker timepicker-24" name="inicio de jornada" v-validate="'required'" id="inicio" value="7:00">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Fin de jornada</label>
                        <div class="col-md-9">
                            <div class="input-icon right" >
                                <i class="fa fa-clock-o"></i>
                                <input type="text" size="5" class="form-control timepicker timepicker-24" name="fin de jornada" v-validate="'required'" id="fin" value="17:00"/>
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
    import VeeValidate,{Validator} from 'vee-validate';
    import es from 'vee-validate/dist/locale/es';
    Validator.localize('es',es);
    Vue.use(VeeValidate);
    import {Bus} from '../../app'
    export default {
        name: "nuevo-horario",
        data: () => ({
            fecha:'',
            inicio:'8:00',
            fin:'17:00',
        }),
        methods:{
            crearNuevo(){
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        let inicio=this.inicio.split(':');
                        let fin=this.fin.split(':');
                        if(inicio[0]>=moment().format('HH') && fin[0]>inicio[0]){
                            axios({
                                method: 'POST',
                                url:locations.origin+location.pathname,
                                params: {
                                    'fecha':this.fecha,
                                    'inicio':this.inicio,
                                    'fin':this.fin,
                                },
                            }).then((response) => {
                                if(response.data.val){
                                    Bus.$emit('cargar-horarios');
                                    this.fecha='';
                                    this.inicio='8:00';
                                    this.inicio='17:00';
                                    toastr.info(response.data.mensaje, "Éxito");
                                }else{
                                    toastr.error(response.data.mensaje, "Error");
                                }
                            }).catch((error) => {
                                toastr.error("Ha ocurrido un error refresque la página", "Error");
                            });

                        }else{
                            toastr.error("La Hora debe ser posterior a la actual y la hora de inicio debe ser menor a la hora de fin", "Error");
                        }
                    }else {
                        toastr.error("Complete el formulario", "Error");
                    }
                });
            }
        },
        mounted(){
            let vm=this;
            $('#fecha').daterangepicker({
                "singleDatePicker": true,
                "showCustomRangeLabel": false,
                "opens": "center",
                "minDate": moment(),
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