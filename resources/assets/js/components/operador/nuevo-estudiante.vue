<template>
    <div class="portlet light bordered">
        <div class="portlet-title tabbable-line">
            <div class="caption">
                <span class="caption-subject font-dark bold uppercase">Nuevo Estudiante</span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="tab-content">
                <div class="tab-pane active">
                    <form v-on:submit.prevent="validar">
                        <fieldset :disabled="cargando">
                            <div class="form-group">
                                <label><span class="text-danger">*</span> Número de identificación</label>
                                <input type="tel" v-model="formulario.identificacion" class="form-control" placeholder="1234567890">
                            </div>
                            <div class="form-group">
                                <label><span class="text-danger">*</span> Nombre Completo</label>
                                <textarea name="nombre" placeholder="Apellido1 Apellido2 Nombre1 Nombre2" v-model="formulario.nombre" cols="2" rows="2" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label> Correo electrónico</label>
                                <input type="email" v-model="formulario.correo" class="form-control" placeholder="nombre@dgepuce.edu.ec">
                            </div>
                            <div class="form-group">
                                <label> Celular</label>
                                <input type="tel" v-model="formulario.celular" class="form-control" placeholder="0998988998">
                            </div>
                            <div class="form-group">
                                <label> Teléfono fijo</label>
                                <input type="tel" v-model="formulario.telefono" class="form-control" placeholder="022998899">
                            </div>
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "nuevo-estudiante",
        data:()=>({
            cargando:false,
            formulario:{
                identificacion:null,
                correo:null,
                nombre:null,
                celular:null,
                telefono:null,
            }
        }),
        methods:{
            validar:function(){
                this.cargando=true;
                this.enviarDatos();
            },
            enviarDatos: _.debounce(function () {
                axios.post("/app/estudiante",this.formulario)
                    .then((response) => {
                        this.cargando=false;
                        if(response.data.val){
                            this.formulario.identificacion=null;
                            this.formulario.correo=null;
                            this.formulario.nombre=null;
                            this.formulario.celular=null;
                            this.formulario.telefono=null;
                            toastr.success(response.data.mensaje);
                        }else{
                            toastr.error(response.data.mensaje);
                        }
                    }).catch(()=>{
                    this.cargando=false;
                });
            }, 500),
        }
    }
</script>

<style scoped>

</style>