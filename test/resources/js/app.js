import Vue from 'vue';
require('./bootstrap');

import VueRouter from 'vue-router'
import ExampleComponent from "./components/ExampleComponent";

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            redirect: '/home'
        },
        {
            path: '/home',
            name: 'home',
            component: ExampleComponent
        },
    ]
})

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);


const app = new Vue({
    router,
    el: '#app',
});
