<template>
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase">Turnos Asignados</span>
            </div>
            <div class="actions">
                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;" title="Actualizar" data-original-title="Actualizar" v-on:click="consulta">
                    <i class="fa fa-refresh"></i>
                </a>
                <a class="btn btn-circle btn-icon-only btn-default fullscreen" data-container="false" data-placement="bottom" href="javascript:;" data-original-title="Pantalla completa" title="Pantalla completa"> </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="mt-element-list">
                <div class="mt-list-head list-default bg-primary">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="list-head-title-container">
                                <h3 class="list-title uppercase sbold">Estudiantes</h3>
                                <div class="list-date">{{actual}}</div>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="list-head-summary-container">
                                <div class="list-pending">
                                    <div class="badge badge-default list-count">{{pendientes}}</div>
                                    <div class="list-label">Pendientes</div>
                                </div>
                                <div class="list-done">
                                    <div class="list-count badge badge-default last">{{completos}}</div>
                                    <div class="list-label">Completos</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-list-container list-default">
                    <ul>
                        <li class="mt-list-item" v-for="item in datos">
                            <div class="list-icon-container done">
                                <a href="javascript:;">
                                    <i class="icon-check"></i>
                                </a>
                            </div>
                            <div class="list-datetime">{{item.inicio_tu}}
                                <br>{{item.fin_tu}}</div>
                            <div class="list-item-content">
                                <h3 class="uppercase bold">
                                    <a href="javascript:;">{{item.apellidos_es}} {{item.nombres_es}}</a>
                                    <a :href="'mailto:'+item.email_es">{{item.email_es}}</a>
                                    <a href="javascript:;">{{item.cedula_es}}</a>
                                </h3>
                                <div class="btn-group btn-group-solid" v-if="tiempo>=item.inicio_tu">
                                    <button type="button" class="btn btn-success" v-on:click="cambiar(3,item)">
                                        Atendido <i class="fa fa-arrow-right"></i></button>
                                    <button type="button" class="btn btn-danger" v-on:click="cambiar(5,item)">
                                        <i class="fa fa-frown-o"></i> No llegó </button>
                                    <button type="button" class="btn btn-warning" v-on:click="cambiar(6,item)" v-if="false">
                                        <i class="fa fa-arrow-up"></i> Transferir</button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "citas",
        data: () => ({
            cargado:false,
            actual:'',
            tiempo:'',
            datos:[],
            pendientes:0,
            completos:0,
        }),
        methods:{
            comprobar:function() {
                let self = this;
                this.tiempo = moment().format('HH:mm:ss');
                setTimeout(self.comprobar, 1000);
            },
            time:function() {
                let self = this;
                this.actual = moment().format('dddd Do MMMM YYYY, HH:mm:ss');
                setTimeout(self.time, 1000);
            },
            consulta:function(){
                axios({
                    method: 'OPTIONS',
                    url:location.origin+location.pathname,
                }).then((response) => {
                    this.datos=response.data.lista;
                    this.pendientes=response.data.pendeientes;
                    this.completos=response.data.completos;
                }).catch((error) => {
                    toastr.error("Ha ocurrido un error refresque la página", "Error");
                });
            },
            cambiar(accion,turno){
                axios({
                    method: 'POST',
                    url:location.origin+location.pathname,
                    params:{
                        'id':turno.id_tu,
                        'estado':accion
                    }
                }).then((response) => {
                    this.consulta();
                    if(response.data.val)
                        toastr.info(response.mensaje, "Éxito");
                    else
                        toastr.error(response.mensaje, "Error");
                }).catch((error) => {
                    toastr.error("Ha ocurrido un error refresque la página", "Error");
                });
            }

        },
        mounted(){
            this.time();
            this.comprobar();
        },
        created(){
            this.consulta();
        }
    }
</script>

<style scoped>

</style>