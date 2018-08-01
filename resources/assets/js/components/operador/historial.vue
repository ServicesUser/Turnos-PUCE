<template>
    <div class="portlet light bordered">
        <div class="portlet-title tabbable-line">
            <div class="caption">
                <i class="icon-globe font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase">Feeds</span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1_1">
                    <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
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
                                            <div class="desc">{{item.detalle_ht}} <span v-if="item.estado">{{item.estado.nombre_et}}</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date">{{item.fecha_et}}</div>
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
    export default {
        name: "historial",
        data: () => ({
            lista:[],
        }),
        methods:{
            cargar:function(){
                axios.get(location.origin+'/app/history')
                    .then((response) => {
                        this.lista=response.data;
                    });
            }
        },
        mounted(){
            this.cargar();
        }
    }
</script>

<style scoped>

</style>