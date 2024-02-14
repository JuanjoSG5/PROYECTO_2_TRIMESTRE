//import NotFound from '@/components/shared/NotFound.vue';
import { createRouter, createWebHashHistory } from 'vue-router';

const routes = [
    { path: '/', component: () => import('@/components/landing/pages/LandingPage.vue'), meta: { showFooter: true }},

    { path: '/contact', component: () => import('@/components/Contact/pages/ContactPage.vue'), meta: { showFooter: true }},
    { path: '/home', component: () => import('@/components/Events/pages/MainPage.vue'), meta: { showFooter: false }},
    { path: '/login', component: () => import('@/components/Login/pages/LoginPage.vue'), meta: { showFooter: true }},
    { path: '/register', component: () => import('@/components/Signup/pages/SignUpPage.vue'), meta: { showFooter: true }},
    { path: '/user', component: () => import('@/components/User/pages/ProfilePage.vue'), meta: { showFooter: false }},
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
})

export default router;