<template>
    <div class="row">
        <div class="col-md-6 col-md-offset-3" v-if="pasos===1">
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-body">
                    <form class="form-horizontal" novalidate="novalidate" v-on:submit.prevent="consultar">
                        <div class="form-body">
                            <div class="alert" :class="mensaje.tipo" v-html="mensaje.texto"></div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-3 control-label">Número de identificación
                                    <span class="required" aria-required="true">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" placeholder="1700123456" name="text" v-model="ci">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-3 control-label">Nombre completo
                                    <span class="required" aria-required="true">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" placeholder="Jhon Will" name="text" v-model="nombres">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-3 control-label">Celular</label>
                                <div class="col-md-8">
                                    <input type="tel" class="form-control" placeholder="0998988998" name="text" v-model="celular">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-3 control-label">Teléfono</label>
                                <div class="col-md-8">
                                    <input type="tel" class="form-control" placeholder="022899088" name="text" v-model="telefono">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green" :disabled="cargando">
                                        <i class="fa fa-spinner fa-pulse fa-fw" v-if="cargando"></i>
                                        Enviar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-md-offset-3" v-else-if="pasos===2">
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-body">
                    <form action="#" class="form-horizontal" novalidate="novalidate" v-on:submit.prevent="actualizar">
                        <div class="form-body">
                            <div class="alert" :class="mensaje.tipo" v-html="mensaje.texto"></div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-3 control-label">Correo electónico
                                    <span class="required" aria-required="true">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" :placeholder="estudiante.email_es" name="email" v-model="correo">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green" :disabled="cargando">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-md-offset-3" v-else-if="pasos===3">
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-body">
                    <form action="#" class="form-horizontal" novalidate="novalidate" v-on:submit.prevent="validarDetalles">
                        <div class="form-body">
                            <div class="alert alert-info"> Completa los campos con asterisco</div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-3 control-label">Escoge una opción
                                    <span class="required" aria-required="true">*</span>
                                </label>
                                <div class="col-md-8">
                                    <div class="radio" v-for="item in tipos">
                                        <label>
                                            <input type="radio" name="tipo" :value="item" v-model="tipo">
                                            {{item.detalle_ti}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-3 control-label">Detalle del requerimiento (opcional)</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" rows="3" v-model="observacion"></textarea>
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
        <div v-else-if="pasos===4">
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-body">
                    <div class="alert text-center" :class="mensaje.tipo" v-html="mensaje.texto"></div>
                    <est-cal :estudiante="estudiante" :tipo="tipo" :observacion="observacion"></est-cal>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-md-offset-3" v-else-if="pasos===5">
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-body" v-if="cargando">
                    <div class="alert text-center" :class="mensaje.tipo" v-html="mensaje.texto"></div>
                    <div class="mt-widget-3">
                        <div class="mt-head bg-green">
                            <div class="mt-head-icon">
                                <i class="fa fa-bullhorn"></i>
                            </div>
                            <div class="mt-head-desc"><b>Su turno es a las {{turno.inicio_tu}}</b> <br>Recuerde estar 10 minutos antes</div>
                            <span class="mt-head-date">{{fechaCompleta}}</span>
                            <div class="mt-head-button" >
                                <h3>{{turno.horario.responsable.cubiculo.detalle_cu ? turno.horario.responsable.cubiculo.detalle_cu :turno.atendido.cubiculo.detalle_cu}}</h3>
                                <br>
                                <a v-if="turno.horario.responsable.cubiculo.link_cu" :href="turno.horario.responsable.cubiculo.link_cu" class="btn btn-primary" target="_blank">ZOOM</a>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-circle red" v-on:click="eliminar" :disabled="loadDel" >Eliminar Reserva</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portlet-body" v-else>
                    <div class="text-center">
                        <h3 class="text-info">Cargando </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {Bus} from '../app';
    export default {
        name: "publico",
        data: () => ({
            estudiante:[],
            pasos:1,
            ci:'',
            correo:'',
            tipo:{id_ti:null},
            observacion:null,
            mensaje:{tipo:'alert-info',texto:'Ingrese sus datos'},
            turno:[],
            cargando:false,
            loadDel:false,

            nombres:null,
            apellidos:null,
            celular:null,
            telefono:null,
            tipos: [],
        }),
        watch:{
            pasos:function(val){
                if(val===5){
                    this.verificar();
                }
            }
        },
        computed:{
            fechaCompleta:function(){
                return moment(this.turno.fecha_tu, 'YYYY-MM-DD').format('dddd, D MMMM YYYY');
            }
        },
        methods:{
            verificar:function(){
                axios({
                    method: 'OPTIONS',
                    url:location.origin+'/api/estudiantes',
                    data:{
                        'estudiante':this.estudiante,
                    }
                }).then((response) => {
                    this.turno=response.data;
                    this.cargando=true;
                });
            },
            consultar:function(){
                if(this.ci!==''){
                    this.cargando=true;
                    axios({
                        method: 'POST',
                        url:location.origin+'/api/publico',
                        data:{
                            'dni':this.ci,
                            'nombres':this.nombres,
                            'apellidos':this.apellidos,
                            'celular':this.celular,
                            'telefono':this.telefono,
                        }
                    }).then((response) => {
                        this.cargando=false;
                        if(response.data.val){
                            this.estudiante=response.data.data;
                            if(this.estudiante.turno===null){
                                this.correo=this.estudiante.email_es;
                                if(this.estudiante.validado_es){
                                    this.pasos=3;
                                    this.mensaje.tipo='alert-info';
                                    this.mensaje.texto='Elija una fecha y presione en <b>Reservar</b>';
                                }else{
                                    this.pasos=2;
                                    this.mensaje.tipo='alert-info';
                                    this.mensaje.texto='Ingrese su correo electrónico';
                                }
                            }else{
                                this.pasos=5;
                                this.mensaje.tipo='alert-info';
                                this.mensaje.texto='La información de su turno';
                            }
                        }else{
                            toastr.error(response.data.mensaje, "Error");
                            this.mensaje.tipo='alert-danger';
                            this.mensaje.texto='Complete el formulario';
                        }
                    }).catch((error) => {
                        this.cargando=false;
                        toastr.error("Ha ocurrido un error refresque la página", "Error");
                    });
                }else{
                    toastr.error("Ingrese una identificación válida", "Error");
                    this.mensaje.tipo='alert-danger';
                }
            },
            validarDetalles:function(){
                if(this.tipo.id_ti>0){
                    this.pasos++;
                }else{
                    toastr.error("Completa el formulario", "Error");
                }
            },
            eliminar:function(){
                this.loadDel=true;
                axios({
                    method: 'PUT',
                    url:location.origin+'/api/estudiantes',
                    data:{
                        'turno':this.turno,
                    }
                }).then((response) => {
                    if(response.data.val){
                        toastr.info(response.data.mensaje, "Éxito");
                        this.consultar();
                    }else{
                        toastr.error(response.data.mensaje, "Error");
                    }
                    this.loadDel=false;
                });
            },
            actualizar:function() {
                if (this.correo !== '') {
                    axios({
                        method: 'PATCH',
                        url:location.origin+'/api/estudiantes',
                        data:{
                            'estudiante':this.estudiante,
                            'email':this.correo
                        }
                    }).then((response) => {
                        if(response.data.val){
                            this.pasos=3;
                            this.mensaje.tipo='alert-info';
                            this.mensaje.texto='Elija una fecha y presione en <b>Reservar</b>';
                        }else{
                            toastr.error(reponse.data.mensaje, "Error");
                        }
                    }).catch((error) => {
                        toastr.error("Ha ocurrido un error refresque la página", "Error");
                    });
                }else{
                    toastr.error("Ingrese un correo electrónico válido", "Error");
                }
            },
            cargarTipos: function(){
                axios({
                    method: 'GET',
                    url:location.origin+'/api/tipos',
                }).then((response) => {
                    this.tipos=response.data;
                });
            }
        },
        mounted(){
            this.cargarTipos();
            Bus.$on('cambiar-paso',function(paso){
                this.pasos=paso;
            }.bind(this));
        }
    }
</script>

<style scoped>

</style>