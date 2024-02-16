import { createRouter } from 'vue-router';
import { createWebHashHistory } from 'vue-router';
//import NotFound from '@/components/shared/NotFound.vue';

const routes = [
    { path: '/', component: () => import('@/components/landing/pages/LandingPage.vue')},

    { path: '/contact', component: () => import('@/components/Contact/pages/ContactPage.vue')},
    { path: '/home', component: () => import('@/components/Events/pages/MainPage.vue')},
    { path: '/login', component: () => import('@/components/Login/pages/LoginPage.vue')},
    { path: '/register', component: () => import('@/components/Signup/pages/SignUpPage.vue')},
    { path: '/user', component: () => import('@/components/User/pages/ProfilePage.vue')},
    //{ path: '/:pathMatch(.*)*', component: NotFound}

]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
})

export default router;