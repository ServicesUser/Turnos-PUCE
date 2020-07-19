
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import JsonExcel from 'vue-json-excel';


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('dispensador', require('./components/turnero'));
Vue.component('dispensador2', require('./components/turnero2'));

Vue.component('downloadExcel', JsonExcel);


const turnero = new Vue({
    el: '#turnero'
});
