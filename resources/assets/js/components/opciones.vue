<template>
    <div class="nav-collapse collapse navbar-collapse navbar-responsive-collapse">
        <ul class="nav navbar-nav">
            <li class="dropdown dropdown-fw dropdown-fw-disabled" v-bind:class="[actual===menu.historial ? 'active open selected' :'']">
                <a href="javascript:;" class="text-uppercase">
                    <i class="icon-home"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-fw">
                    <li :class="actual===menu.historial ? 'active' : ''">
                        <a :href="menu.historial">Historial</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown dropdown-fw dropdown-fw-disabled" v-bind:class="[actual===menu.horarios || actual===menu.citas ? 'active open selected' :'']">
                <a href="javascript:;" class="text-uppercase">
                    <i class="icon-puzzle"></i> Turnos
                </a>
                <ul class="dropdown-menu dropdown-menu-fw">
                    <li :class="actual===menu.horarios ? 'active' : ''">
                        <a :href="menu.horarios">Horario Atención</a>
                    </li>
                    <li :class="actual===menu.citas ? 'active' : ''">
                        <a :href="menu.citas">Citas</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown dropdown-fw dropdown-fw-disabled" v-bind:class="[actual===menu.estudiante ? 'active open selected' :'']">
                <a href="javascript:;" class="text-uppercase">
                    <i class="fa fa-graduation-cap"></i> Estudiantes
                </a>
                <ul class="dropdown-menu dropdown-menu-fw">
                    <li :class="actual===menu.estudiante ? 'active' : ''">
                        <a :href="menu.estudiante">Nuevo/Estado</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<script>
    import {Bus} from '../app';
    export default {
        name: "opciones",
        data: () => ({
            menu:[],
            cargado:false
        }),
        computed:{
            actual:function(){
                return location.origin+location.pathname;
            }
        },
        mounted(){
            Bus.$on('cargar-menu',function(menu){
                this.menu=menu;
                this.cargado=true;
            }.bind(this));
        }
    }
</script>

<style scoped>

</style>