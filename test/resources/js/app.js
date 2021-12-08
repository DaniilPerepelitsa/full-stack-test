import Vue from 'vue';
require('./bootstrap');

import VueRouter from 'vue-router'
import ExampleComponent from "./components/Categories";
import Posts from "./components/Posts";
import PostItem from "./components/PostItem";

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
        {
            path: '/categories/:id/posts',
            name: 'posts',
            component: Posts,
            props: true
        },
        {
            path: '/post/:id/show',
            name:'show-post',
            component: PostItem,
            props: true
        }
    ]
})

const app = new Vue({
    router,
    el: '#app',
});
