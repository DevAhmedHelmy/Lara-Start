import VueRouter from 'vue-router';


Vue.use(VueRouter);

let routes = [
    {
        path: '/dashboard',
        component: require('./views/dashboard/Dashboard.vue').default
    },
    {
        path: '/users',
        component: require('./views/dashboard/Users.vue').default
    },
    {
        path: '/profile',
        component: require('./views/dashboard/Profile.vue').default
    }
]

export default new VueRouter({
    mode: 'history',
    routes
});
