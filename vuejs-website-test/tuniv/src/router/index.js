import { createRouter, createWebHistory } from "vue-router";
import Home from '@views/home.vue';
import Information from '@views/Information.vue';

const routes = [
    {
        name: 'Home',
        path: '/',
        component: Home,
    }, {
        name: 'Information',
        path: '/information',
        component: Information,
    }

];

const router = createrRouter({
    history: createWebHistory(),
    routes,
})