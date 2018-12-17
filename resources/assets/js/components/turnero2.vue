<template>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <fullscreen ref="fullscreen" @change="fullscreenChange" background="#fff">
                <div class="portlet light bordered">
                    <div class="portlet-body">
                        <div class="text-center">
                            <div class="m-login__welcome center-block">
                                <object type="image/svg+xml" :data="imagen" class="img-responsive" style="max-height: 50px"></object>
                            </div>
                        </div>
                        <div class="row">
                            <form class="form-inline" role="form" v-on:submit.prevent="enviar">
                                <div class="form-group">
                                    <label class="sr-only">Módulo</label>
                                    <select class="form-control" v-model="modulo">
                                        <option v-for="item in modulos" :value="item.id_cu">{{item.detalle_cu}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Fecha</label>
                                    <input type="date" class="form-control" placeholder="yyyy-mm-dd" v-model="fecha">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Desde</label>
                                    <input type="number" class="form-control" placeholder="12" v-model="desde">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Hasta</label>
                                    <input type="number" class="form-control" placeholder="15" v-model="hasta">
                                </div>
                                <button type="submit" class="btn btn-default">Consultar</button>
                            </form>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="list-group">
                                    <a href="javascript:;" class="list-group-item" v-for="item in lista.toca">
                                        <h4 class="list-group-item-heading"><b>{{item.inicio_tu}} {{item.detalle_cu}}</b></h4>
                                        <p class="list-group-item-text">{{item.nombres_es}} {{item.apellidos_es}}</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="list-group">
                                    <a href="javascript:;" class="list-group-item danger" v-for="item in lista.paso" :class="item.id_et===3 ? 'list-group-item-success' : item.id_et===1 ? 'list-group-item-warning' : 'list-group-item-danger'">
                                        <h4 class="list-group-item-heading"><b>{{item.inicio_tu}} {{item.detalle_cu}}</b></h4>
                                        <p class="list-group-item-text">{{item.nombres_es}} {{item.apellidos_es}} <span class="label" :class="item.id_et===3 ? 'label-success' : 'label-danger'">{{item.nombre_et}}</span></p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </fullscreen>
                <button type="button" @click="toggle" class="btn btn-default boton" :class="fullscreen ? 'full' : ''"><i class="fa" :class="[fullscreen ? 'fa-window-close-o' : 'fa-arrows-alt']"></i></button>
            </div>
        </div>
    </div>
</template>

<script>
    import fullscreen from 'vue-fullscreen';
    Vue.use(fullscreen);
    export default {
        name: "turnero",
        data: () => ({
            lista:[],
            fullscreen: false,
            fecha:null,
            desde:null,
            hasta:null,
            modulo:null,
            modulos:[],
        }),
        watch:{
        },
        computed:{
            imagen:function(){
                return location.origin+'/images/logo_puce.svg';
            }
        },
        methods:{
            enviar:function(){
                axios({
                    method: 'POST',
                    url:location.origin+location.pathname,
                    params: {
                        'fecha':this.fecha,
                        'desde':this.desde,
                        'hasta':this.hasta,
                        'modulo':this.modulo,
                    },
                }).then((response) => {
                    if(response.data.val)
                        this.lista=response.data;
                    else
                        toastr.error(response.data.mensaje, "Error");

                }).catch((error) => {
                    toastr.error("Ha ocurrido un error refresque la página", "Error");
                });
            },
            toggle:function() {
                this.$refs['fullscreen'].toggle();
            },
            fullscreenChange:function(fullscreen) {
                this.fullscreen = fullscreen
            },
            cargarCu:function(){
                axios.options(window.location.origin+location.pathname)
                    .then((response) => {
                        this.modulos=response.data;
                    });
            },
            cargar:function(){
                axios.get(window.location.origin+'/api/realtime')
                    .then((response) => {
                        this.lista=response.data;
                    });
            }
        },
        mounted(){
            this.cargarCu();
        }
    }
</script>

<style scoped>
    .boton{
        position: absolute;
        right: 10px;
        bottom: 10px;
        width: 36px;
        height: 36px;
        padding: 0;
        font-size: 36px;
        line-height: 0px !important;
        text-align: center;
        outline: none;
    }
    .full{
        left: 10px;
        top: 10px;
        right: auto;
        bottom: auto;
    }
    .portlet-body{
        min-height: 100% !important;
    }

</style>