<template>
    <div class="clearfix navbar-fixed-top" v-if="cargado">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="sr-only">Navegacion</span>
            <span class="toggle-icon">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </span>
        </button>
        <a class="page-logo" :href="ruta+'/home'">
            <img :src="ruta+'/images/logo_puce_blanco.png'" alt="Logo PUCE">
        </a>
        <div class="topbar-actions">
            <notificaciones :usuario="datos.user" :l="datos.notificaciones"></notificaciones>
            <div class="btn-group-notification btn-group">
                <button type="button" class="btn btn-sm md-skip" v-on:click="turnero2">
                    <i class="fa fa-list-ul"></i>
                </button>
            </div>
            <div class="btn-group-red btn-group">
                <button type="button" class="btn btn-sm md-skip" v-on:click="turnero">
                    <i class="fa fa-list-ul"></i>
                </button>
            </div>
            <div class="btn-group-img btn-group">
                <button type="button" class="btn btn-sm md-skip dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <span>{{datos.user.name}}</span>
                </button>
                <ul class="dropdown-menu-v2" role="menu">
                    <li>
                        <a href="/configuracion">
                            <i class="icon-user"></i> Configuración
                        </a>
                    </li>
                    <li class="divider"> </li>
                    <li>
                        <a href="#salir" v-on:click="salir">
                            <i class="icon-key"></i> Cerrar sesión </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import {Bus} from '../app';
    export default {
        name: "cabeza",
        data: () => ({
            datos:[],
            cargado:false
        }),
        computed:{
            ruta:function(){
                return location.origin;
            }
        },
        methods:{
            salir:function(){
                axios.post(location.origin+'/logout');
                location.href=location.origin+'/login';
            },
            cargar:function(){
                axios.get(window.location.origin+'/app/basic')
                    .then((response) => {
                        if(response.data){
                            this.datos=response.data;
                            this.cargado=true;
                            Bus.$emit('cargar-menu',response.data.menu);
                        }
                    });

            },
            turnero:function(){
                window.open(location.origin+'/cola', "", "width=600,height=600");
            },
            turnero2:function(){
                window.open(location.origin+'/cola2', "", "width=600,height=600");
            }
        },
        created(){
            this.cargar();
        }
    }
</script>

<style scoped>

</style>