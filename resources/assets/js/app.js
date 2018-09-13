
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import Home from './components/Home'
import SinglePost from './components/SinglePost'
import Profile from './components/Profile'
import Vue from 'vue'
import Vuex from 'vuex'
import StoreData from './store'


Vue.use(Vuex)

Vue.use(VueRouter)
const store = new Vuex.Store(StoreData)

const routes =[
    {
        path: '/',
        component: Home,
        name: 'home'
    },
    {
        path: '/singlepost/:id',
        component: SinglePost,
        name: 'single-post'
    },
    {
        path: '/profile/:id',
        component: Profile,
        name: 'profile'
    }
]

const router = new VueRouter({
    routes,
    //mode: 'history'
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    router,
    store
});
