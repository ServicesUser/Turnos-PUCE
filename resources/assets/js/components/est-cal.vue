<template>
    <vue-event-calendar :events="lista" title="Turnos disponibles">
        <template slot-scope="props">
            <div v-for="(event, index) in props.showEvents" class="event-item">
                <small>
                {{event.fecha}} {{event.inicio}} a {{event.fin}} ({{event.detalle_cu}})
                </small>
                <button class="btn btn-circle green btn-outline btn-sm" v-on:click="reserva(event)">Reservar</button>
            </div>
        </template>
    </vue-event-calendar>
</template>
<script>
    import 'vue-event-calendar/dist/style.css';
    import {Bus} from '../app';
    import vueEventCalendar from 'vue-event-calendar';
    Vue.use(vueEventCalendar, {locale: 'es',color:'#4CBFDC'});
    export default {
        name: "est-cal",
        data: () => ({
            lista:[],
            fecha:moment().format('YYYY/MM/DD'),
        }),

        props:['estudiante'],
        methods:{
            cargar:function(){
                axios({
                    method: 'GET',
                    url:location.origin+'/api/turnos',
                    params:{
                        'fecha':moment().format('Y-MM-DD HH:mm:ss'),
                    }
                }).then((response) => {
                    this.lista=response.data;
                }).catch((error) => {
                    toastr.error("Ha ocurrido un error refresque la página", "Error");
                });
            },
            reserva:function(turno){
                axios({
                    method: 'DELETE',
                    url:location.origin+'/api/estudiantes',
                    params:{
                        'estudiante':this.estudiante,
                        'fecha':turno.fecha,
                        'turno':turno
                    }
                }).then((response) => {
                    if(response.data.val){
                        toastr.info(response.data.mensaje, "Éxito");
                        Bus.$emit('cambiar-paso',4);
                    }else{
                        toastr.error(response.data.mensaje, "Error");
                    }
                }).catch((error) => {
                    toastr.error("Ha ocurrido un error refresque la página", "Error");
                });
            }
        },
        mounted(){
            this.cargar();
            this.$EventCalendar.toDate(this.fecha);
        }
    }
</script>

<style>
    .__vev_calendar-wrapper .cal-wrapper .cal-body .dates .item .date-num {
        font-size: 2rem;
    }
</style>