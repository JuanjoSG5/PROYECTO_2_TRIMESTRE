import { createRouter, createWebHashHistory } from 'vue-router';
import { useAuthStore } from '@/store/UserStore.js';


const routes = [
    { path: '/', component: () => import('@/components/landing/pages/LandingPage.vue'), meta: { showFooter: true, showHeader: true } },
    { path: '/contact', component: () => import('@/components/Contact/pages/ContactPage.vue'), meta: { showFooter: true,  showHeader: true } },
    { path: '/home', component: () => import('@/components/Events/pages/MainPage.vue'), meta: { showFooter: false, showHeader: false } },
    { path: '/login', component: () => import('@/components/Login/pages/LoginPage.vue'), meta: { showFooter: true, showHeader: true } },
    { path: '/register', component: () => import('@/components/Signup/pages/SignUpPage.vue'), meta: { showFooter: true, showHeader: true } },
    {
        path: '/user', component: () => import('@/components/User/pages/ProfilePage.vue'), meta: { showFooter: false,showHeader: true},
        beforeEnter: (to, from, next) => {
            const store = useAuthStore()
            if (store.token !== "") {
                next();
            } else {
                next('/login');
            }
        }
    },
    { path: '/:catchAll(.*)', component: () => import('@/components/shared/pages/NotFoundPage.vue') }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
})

export default router;
