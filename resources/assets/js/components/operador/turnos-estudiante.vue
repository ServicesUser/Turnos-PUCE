<template>
    <div class="portlet light bordered">
        <div class="portlet-title tabbable-line">
            <div class="caption">
                <span class="caption-subject font-dark bold uppercase">Turnos tomados</span>
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
                            <button type="submit" class="btn btn-primary">Consultar</button>
                        </fieldset>
                    </form>
                    <div class="padding-tb-10" v-if="consultado">
                        <div class="list-group">
                            <div class="list-group-item" v-for="item in lista">
                                <h5 class="list-group-item-heading"><b>Turno: </b>{{item.inicio_tu}} {{item.fin_tu}} {{item.fecha_tu}}</h5>
                                <div class="list-group-item-text">
                                    <p>Estado: {{item.estado.nombre_et}}</p>
                                    <p>{{item.horario.responsable.name}} {{item.horario.responsable.cubiculo.detalle_cu}}</p>
                                </div>
                            </div>
                            <div class="text-center" v-if="lista.length===0">
                                No tiene turnos registrados
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
        name: "nuevo-estudiante",
        data:()=>({
            cargando:false,
            consultado:false,
            formulario:{
                identificacion:null,
            },
            lista:[],
        }),
        methods:{
            validar:function(){
                this.cargando=true;
                this.enviarDatos();
            },
            enviarDatos: _.debounce(function () {
                axios.post("/app/turnos",this.formulario)
                    .then((response) => {
                        this.cargando=false;
                        if(response.data.val===false){
                            toastr.error(response.data.mensaje);
                        }else{
                            this.lista=response.data;
                            this.consultado=true;
                            this.formulario.identificacion=null;
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