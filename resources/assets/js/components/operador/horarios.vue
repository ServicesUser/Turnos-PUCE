<template>
    <div class="portlet light bordered">
        <div class="portlet-title tabbable-line">
            <div class="caption">
                <i class="icon-globe font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase">Horarios de antención registrados</span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="scroller" style="height: 539px;" data-always-visible="1" data-rail-visible="0">
                        <ul class="feeds">
                            <li v-for="item in lista">
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-success">
                                                <i class="fa fa-bell-o"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc">
                                                You have 4 pending tasks.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date"> Just now </div>
                                </div>
                            </li>
                            <li v-if="lista.length===0">
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-danger">
                                                <i class="fa fa-times"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc">
                                                No existen horarios registrados
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {Bus} from '../../app'
    export default {
        name: "horarios",
        data: () => ({
            lista:[],
            cargado:false
        }),
        methods:{
            cargar:function(){
                axios.options(location.origin+location.pathname)
                    .then((response) => {
                        this.lista=response.data;
                        this.cargado=true;
                    }).catch((error) => {
                        toastr.error("Ocurrió un error vuelva a cargar la página.", "Error");
                });
            }
        },
        mounted(){
            this.cargar();
            Bus.$on('cargar-horarios',function(){
                this.cargar();
            }.bind(this));
        }
    }
</script>

<style scoped>

</style>