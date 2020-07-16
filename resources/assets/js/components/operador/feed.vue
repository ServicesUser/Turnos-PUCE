<template>
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
                        <div class="desc">{{item.detalle_ht}}</div>
                    </div>
                </div>
            </div>
            <div class="col2">
                <div class="date">{{item.fecha_ht | fecha}}</div>
            </div>
        </li>
    </ul>
</template>

<script>
    import moment from "moment";
    moment.locale("es");
    export default {
        name: "feed",
        data:()=>({
            lista:[],
            cargando:true,
        }),
        methods:{
            consultar:function(){
                axios.post("/app/feed")
                    .then((response) => {
                        this.lista=response.data;
                        this.cargado=false;
                    });
            }
        },
        filters:{
            fecha: function (value) {
                let date = moment(value);
                return date.fromNow();
            }
        },
        created() {
            this.consultar()
        }
    }
</script>

<style scoped>
    .col1{
        width: 90% !important;
    }
    .col2{
        width: 10% !important;
        float: right !important;
    }

</style>