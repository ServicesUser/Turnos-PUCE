<template>
    <div class="btn-group-notification btn-group" v-if="cargado">
        <button type="button" class="btn btn-sm md-skip dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            <i class="icon-bell"></i>
            <span class="badge">{{lista.length}}</span>
        </button>
        <ul class="dropdown-menu-v2" v-if="lista.length>0">
            <li class="external">
                <h3><span class="bold">{{lista.length}}</span> notificaciones</h3>
                <a href="#">ver todas</a>
            </li>
            <li>
                <ul class="dropdown-menu-list scroller" style="height: 250px; padding: 0;" data-handle-color="#637283">
                    <li v-for="item in lista">
                        <a :href="item.url ? item.url : '#'">
                            <span class="details">
                                <span class="label label-sm label-icon label-info md-skip">
                                </span>{{item.mensaje}}</span>
                            <span class="time">{{item.fecha}}</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<script>
    import {Bus} from '../app';
    export default {
        name: "notificaciones",
        data: () => ({
            lista:[],
            cargado:false
        }),
        mounted(){
            Bus.$on('cargar-notificaciones',function(menu){
                this.lista=menu;
                this.cargado=true;
            }.bind(this));
        }
    }
</script>

<style scoped>

</style>