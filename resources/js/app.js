/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('area-chart-widget-card', require('./components/Chart/AreaChartWidgetCard.vue').default);
Vue.component('area-chart-card', require('./components/Chart/AreaChartCard.vue').default);
Vue.component('radial-bar-card', require('./components/Chart/RadialBarCard.vue').default);
Vue.component('bar-chart-widget-card', require('./components/Chart/BarChartWidgetCard.vue').default);
Vue.component('greenhouse-dashboard', require('./components/GreenhouseDashboard.vue').default);
Vue.component('greenhouse-conditions', require('./components/GreenhouseConditions.vue').default);
Vue.component('greenhouse-override-container', require('./components/GreenhouseOverrideContainer.vue').default);
Vue.component('greenhouse-clear-conditions', require('./components/GreenhouseClearConditions.vue').default);
Vue.component('TouchSpinner', require('./components/Chart/VueTouchSpinner.vue').default);

import VueApexCharts from 'vue-apexcharts';
import Toasted from 'vue-toasted';

Vue.use(Toasted);
Vue.component('apexchart', VueApexCharts)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
