
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
// require("jquery/dist/jquery.min.js");
require("popper.js/dist/umd/popper.min.js");
require("bootstrap/dist/js/bootstrap.min.js");

require("./bootstrap");
// require('./vendor/pace-progress/pace.js');
require("perfect-scrollbar/dist/perfect-scrollbar.min.js");
require("@coreui/coreui/dist/js/coreui.min.js");
require("chart.js/dist/Chart.min.js");
require("@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js");
window.Vue = require('vue');

// require('./main');
// import Vuetify from 'vuetify/lib'
import VueRouter from 'vue-router';
// Vue.use(require('vue-resource'));
// Import component
import Loading from "vue-loading-overlay";
// Import stylesheet
import "vue-loading-overlay/dist/vue-loading.css";
import Dashboard from './components/Dashboard.vue';
import Welcome from './components/Welcome.vue';
import UserIndex from './components/user/UserIndex.vue';
import UserProfile from './components/user/UserProfile.vue';
import ReportIndex from './components/report/ReportIndex.vue';
import DashMap from './components/Map.vue';

import Vue from 'vue';
Vue.component('loading',Loading);
Vue.component('example', require('./components/ExampleComponent.vue'));
// Vue.component('v-app', require('./components/App.vue'));

window.Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        components: {
            dashboard: Dashboard
        }
    },
    { path: '/users', component: UserIndex, name: 'userIndex' }
    , { path: '/reports', component: ReportIndex, name: 'reportIndex' }
    , { path: '/welcome', component: Welcome, name: 'welcome' }
    , { path: '/map', component: DashMap, name: 'map' }
    , { path: '/users/profile/:email', component: UserProfile, name: 'userProfile' }
]

const router = new VueRouter({ routes })


const app = new Vue({
    router }).$mount('#app')
