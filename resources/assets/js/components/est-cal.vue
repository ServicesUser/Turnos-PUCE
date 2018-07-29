<template>
    <vue-event-calendar :events="demoEvents" title="te convence"></vue-event-calendar>
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
                    date: '2018/07/28', // Required
                    title: 'Foo' // Required
                }, {
                    date: '2016/12/15',
                    title: 'Bar',
                    desc: 'description',
                    customClass: 'disabled highlight' // Custom classes to an calendar cell
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