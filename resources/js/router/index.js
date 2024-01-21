import { createRouter, createWebHistory } from 'vue-router';
import store from '@/store';

/***** */


/***** */ 

import DashBoard from '@/admin/DashBoard.vue';


import PageNotFound from '@/PageNotFound.vue';


import Login from '@/admin/Login.vue';
import ForgotPassword from '@/admin/ForgotPassword.vue';
import PasswordReset from '@/admin/PasswordReset.vue';
import Register from '@/admin/Register.vue';
import CreateUser from '@/admin/CreateUser.vue';
import Users from '@/admin/Users.vue';

import Auth from '@/auth.js';

const routes = [

    {path: '/login', component: Login,name: "Login",meta: { layout: 'auth' },},
    {path: '/register',component: Register,name: "Register",meta: { layout: 'auth' },},
    {path: '/admin/create-user',component: CreateUser,name: "Create User",meta: { requiresAuth: true },},
    {path: '/admin/users' , component: Users , name: "System User" , meta: { requiresAuth: true },},
    
    {path: '/admin/forgot-password', component: ForgotPassword ,name: "ForgotPassword",meta: { layout: 'auth' },},
    {path: '/password/reset', component: PasswordReset ,name: "PasswordReset",meta: { layout: 'auth' },},


    
    {path: '/admin' , name:"Dashboard" , component:DashBoard , meta: {requiresAuth: true}},    


    
    {path: '/:catchAll(.*)*', name: "PageNotFound",component: PageNotFound,meta: { layout: 'front' }},

    
    
];

const router = new createRouter({    
    history: createWebHistory(),
    linkExactActiveClass: 'active',
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else {
            return { left: 0, top: 0 }; 
        }
    },
});



router.beforeEach((to, from, next) => {


    if (to.meta && to.meta.layout && to.meta.layout == 'auth') 
    {
        store.commit('setLayout', 'auth');            
    } 
    else if (to.meta && to.meta.layout && to.meta.layout == 'front') 
    {
        store.commit('setLayout', 'front');            
    } 
    else 
    {
        store.commit('setLayout', 'app');
    }

    if (to.matched.some(record => record.meta.requiresAuth) ) {
        if (Auth.check()) {
            next();
            return;
        } else {
            router.push('login');
        }
    } else {
        next();
    }
});

export default router;
