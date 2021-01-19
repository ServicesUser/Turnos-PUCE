<template>
    <div class="portlet light bordered">
        <div class="portlet-title tabbable-line">
            <div class="caption">
                <i class="icon-globe font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase">Lista de turnos</span>
            </div>
            <div class="actions">
                <button title="Eliminar" class="btn btn-circle btn-icon-only btn-default" :disabled="aeliminar.length===0" type="button" v-on:click="eliminar">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        </div>
        <div class="portlet-body from">
            <div class="scroller" style="height: 239px;" data-always-visible="1" data-rail-visible="0">
                <ul class="feeds">
                    <li v-for="item in lista">
                        <div class="item" :key="item.id_tu">
                            <label>
                                <input type="checkbox" :value="item.id_tu" name="deleted" v-model="aeliminar"
                                       :disabled="!item.id_et===1">
                                {{item.fecha_tu +' '+item.inicio_tu | fecha}}
                            </label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from "moment";
    moment.locale("es");
    export default {
        name: "lista-turnos",
        data: () => ({
            lista: [],
            aeliminar: []
        }),
        filters:{
            fecha: function (value) {
                let date = moment(value);
                return date.format("LLLL");
            }
        },
        methods: {
            consultar: function () {
                axios({
                    method: 'PUT',
                    url: location.origin + location.pathname,
                }).then((response) => {
                    this.lista = response.data.data;
                }).catch((error) => {
                    toastr.error("Ha ocurrido un error refresque la página", "Error");
                });
            },
            eliminar: function () {
                this.$swal({
                    title: "Eliminar Turnos Generados",
                    html: '<b>¿Está seguro que quiere eliminar '+ this.aeliminar.length +' turnos seleccionados?</b>',
                    icon: 'question',
                    showLoaderOnConfirm: true,
                    showCancelButton: true,
                    confirmButtonText: 'Si',
                    confirmButtonAriaLabel: 'No',
                    cancelButtonText: 'No',
                    cancelButtonAriaLabel: 'Si',
                    preConfirm: (aux) => {
                        return this.enviarEliminacion().then(() => {
                            return aux;
                        });
                    }
                });
            },
            enviarEliminacion: function() {
                return axios({
                    method: 'DELETE',
                    url: location.origin + location.pathname,
                    data: {turnos: this.aeliminar}
                }).then(()=>{
                    this.consultar();
                    toastr.success("Se han Eliminado "+this.aeliminar.length+" turnos");
                    this.aeliminar = [];
                    return true;
                }).catch(()=>{
                    toastr.error("Ha ocurrido un error", "Error");
                    return false;
                });
            }
        },
        created() {
            this.consultar();
        }
    }
</script>

<style scoped>

</style>