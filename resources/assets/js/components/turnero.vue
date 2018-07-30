<template>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="portlet light bordered">
                    <div class="portlet-body">
                        <div class="text-center">
                            <div class="m-login__welcome center-block">
                                <object type="image/svg+xml" :data="imagen" class="img-responsive" style="max-height: 150px"></object>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="list-group">
                                    <a href="javascript:;" class="list-group-item active">
                                        <h4 class="list-group-item-heading">List group item heading</h4>
                                        <p class="list-group-item-text"> Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit. </p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="list-group">
                                    <a href="javascript:;" class="list-group-item active">
                                        <h4 class="list-group-item-heading">List group item heading</h4>
                                        <p class="list-group-item-text"> Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit. </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "turnero",
        data: () => ({
            lista:[],
        }),
        computed:{
            imagen:function(){
                return location.origin+'/images/logo_puce.svg';
            }
        },
        methods:{
            cargar:function(){
                axios.get(window.location.origin+'/api/realtime')
                    .then((response) => {
                        this.lista=response.data;
                    });
            },
        },
        mounted(){
            Echo.channel('Turnos')
                .listen('Turno',(e) => {
                    console.log(e);
                    this.cargar();
                });
        }
    }
</script>

<style scoped>

</style>