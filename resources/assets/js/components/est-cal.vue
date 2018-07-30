<template>
    <vue-event-calendar :events="demoEvents">
        <template slot-scope="props">
            <div v-for="(event, index) in props.showEvents" class="event-item">
                <h4>Turno de {{event.inicio}} a {{event.fin}}</h4>
                <button class="btn btn-success">Reservar</button>
            </div>
        </template>
    </vue-event-calendar>
</template>
<script>
    import 'vue-event-calendar/dist/style.css';
    import vueEventCalendar from 'vue-event-calendar';
    Vue.use(vueEventCalendar, {locale: 'es',color:'#4CBFDC'});
    export default {
        name: "est-cal",
        data () {
            return {
                demoEvents: [{
                    date: '2018/07/30 8:00:00', // Required
                    inicio:'8:00',
                    fin:'8:20',
                    title: 'Foo' // Required
                }, {
                    date: '2018/07/30 8:25:00',
                    title: 'Bar',
                    inicio:'8:25',
                    fin:'8:50',
                    desc: 'description'
                }]
            }
        }
    }
</script>

<style>
    .__vev_calendar-wrapper .cal-wrapper .cal-body .dates .item .date-num {
        font-size: 2rem;
    }
</style>