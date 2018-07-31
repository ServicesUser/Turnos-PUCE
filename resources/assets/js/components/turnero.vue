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
                                    <a href="javascript:;" class="list-group-item danger" v-for="item in lista.paso" :class="item.id_et===3 ? 'list-group-item-success' : 'list-group-item-danger'">
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
    require('tone');
    import fullscreen from 'vue-fullscreen';
    Vue.use(fullscreen)
    export default {
        name: "turnero",
        data: () => ({
            lista:[],
            sonido:0,//new Tone.PolySynth(4, Tone.Synth).toMaster(),
            fullscreen: false,
        }),
        watch:{
            'lista':function(){
                //this.sonido.triggerAttack(['C4', 'E4', 'G4', 'B4'])
            }
        },
        computed:{
            imagen:function(){
                return location.origin+'/images/logo_puce.svg';
            }
        },
        methods:{
            toggle:function() {
                this.$refs['fullscreen'].toggle() // recommended
                // this.fullscreen = !this.fullscreen // deprecated
            },
            fullscreenChange:function(fullscreen) {
                this.fullscreen = fullscreen
            },
            cargar:function(){
                axios.get(window.location.origin+'/api/realtime')
                    .then((response) => {
                        this.lista=response.data;
                    });
            }
        },
        mounted(){
            Echo.channel('Turnos')
                .listen('Turno',(e) => {
                    console.log(e);
                    this.cargar();
                });
            this.cargar();
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