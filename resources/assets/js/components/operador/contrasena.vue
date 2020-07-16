<template>
    <div class="portlet light bordered">
        <div class="portlet-title tabbable-line">
            <div class="caption">
                <span class="caption-subject font-dark bold uppercase">Contraseña</span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="tab-content">
                <div class="tab-pane active">
                    <form v-on:submit.prevent="validar">
                        <fieldset :disabled="cargando">
                            <div class="form-group">
                                <label><span class="text-danger">*</span> Contrasena</label>
                                <input type="password" v-model="formulario.contrasnea" class="form-control" placeholder="Nueva Contraseña">
                            </div>
                            <div class="form-group">
                                <label><span class="text-danger">*</span> Repita Contrasena</label>
                                <input type="password" v-model="formulario.rcontrasnea" class="form-control" placeholder="Nueva Contraseña">
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
        name: "contrasena",
        data:()=>({
            cargando:false,
            formulario:{
                contrasnea:null,
                rcontrasnea:null,
            }
        }),
        methods:{
            validar:function(){
                if(this.formulario.rcontrasnea===this.formulario.contrasnea){
                    this.cargando=true;
                    this.enviarDatos();
                }else{
                    toastr.error("Las contraseñas no coinciden", "Error");
                }
            },
            enviarDatos: _.debounce(function () {
                axios.post("/app/contrasena",{password:this.formulario.contrasnea})
                    .then((response) => {
                        this.cargando=false;
                        this.formulario.rcontrasnea=null;
                        this.formulario.contrasnea=null;
                        toastr.success(response.data.mensaje);
                    }).catch(()=>{
                    this.cargando=false;
                });
            }, 500),
        }
    }
</script>

<style scoped>

</style>