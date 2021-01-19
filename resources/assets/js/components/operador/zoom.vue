<template>
    <div class="portlet light bordered">
        <div class="portlet-title tabbable-line">
            <div class="caption">
                <span class="caption-subject font-dark bold uppercase">Parámetros</span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="tab-content">
                <div class="tab-pane active">
                    <form v-on:submit.prevent="validar">
                        <fieldset :disabled="cargando">
                            <div class="form-group">
                                <label>Zoom Link</label>
                                <input type="url" v-model="formulario.zoom" class="form-control" placeholder="https://zoom.us/">
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "zoom",
        data:()=>({
            cargando:false,
            formulario:{
                cubiculo:null,
                zoom:null,
            }
        }),
        methods:{
            validar:function(){
                this.cargando=true;
                this.enviarDatos();
            },
            cargar:function(){
                this.cargando=true;
                axios.get("/app/configuracion")
                    .then((response) => {
                        this.cargando=false;
                        this.formulario.zoom=response.data.link_cu;
                    }).catch(()=>{
                    this.cargando=false;
                });
            },
            enviarDatos: _.debounce(function () {
                axios.post("/app/configuracion",this.formulario)
                    .then((response) => {
                        if(response.data.val){
                            toastr.success(response.data.mensaje);
                        }else{
                            toastr.error(response.data.mensaje);
                        }
                        this.cargando=false;
                    }).catch(()=>{
                        this.cargando=false;
                });
            }, 500),
        },
        created() {
            this.cargar();
        }
    }
</script>

<style scoped>

</style>