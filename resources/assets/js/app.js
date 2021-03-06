// import '@babel/polyfill';
// import '@babel/preset-env';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueSweetalert2 from 'vue-sweetalert2';


Vue.use(VueSweetalert2);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('cabeza', require('./components/cabeza'));
Vue.component('notificaciones', require('./components/notificaciones'));
Vue.component('opciones', require('./components/opciones'));
Vue.component('pie', require('./components/pie'));

Vue.component('est-cal', require('./components/est-cal'));

Vue.component('nuevo-horario', require('./components/operador/nuevo-horario'));
Vue.component('horarios', require('./components/operador/horarios'));
Vue.component('citas', require('./components/operador/citas'));
Vue.component('feed', require('./components/operador/feed'));
Vue.component('parametros', require('./components/operador/zoom'));
Vue.component('contrasena', require('./components/operador/contrasena'));
Vue.component('nuevo-estudiante', require('./components/operador/nuevo-estudiante'));
Vue.component('turnos-estudiante', require('./components/operador/turnos-estudiante'));


Vue.component('estudiante', require('./components/estudiante'));
Vue.component('publico', require('./components/publico'));

export let Bus = new Vue();

const app = new Vue({
    el: '#app'
});
