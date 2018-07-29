<template>
    <vue-event-calendar :events="demoEvents">
        <template slot-scope="props">
            <div v-for="(event, index) in props.showEvents" class="event-item">
                {{event}}
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
                    date: '2018/07/25 16:28:52', // Required
                    title: 'Foo' // Required
                }, {
                    date: '2016/12/15',
                    title: 'Bar',
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