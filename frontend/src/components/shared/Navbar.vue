<template>
    <nav >
        <ul class="navbar">
            <router-link class="route icon" to="/"><Icon height="2.5rem" class="icon" icon="noto:hourglass-done" /></router-link>
            <router-link class="route" to="/contact">Contact</router-link>
            <router-link v-if="!isLoggedIn" class="route" to="/login">Login</router-link>
            <router-link v-if="!isLoggedIn" class="route register" to="/register">Register</router-link>
            <router-link v-else class="route" to="/user">User</router-link>
        </ul>
    </nav>
</template>

<script>
import { Icon } from '@iconify/vue';
import { useAuthStore } from '../../store/UserStore.js';

export default {
    components:{
        Icon
    },
    setup() {
        const store = useAuthStore();

        return {
            isLoggedIn: store.username === null
        };
    }
};
</script>

  
<style scoped>

.navbar {
    display: flex;
    padding-top: 1rem;
    width: 90%;
    justify-content: space-between;
    align-items: center;
    color: white;
    padding-right: 3rem;
}

@media (max-width: 768px) {
    .navbar {
        width: 100%;    
        padding: 0;
        margin: 0;
        justify-content:safe;
    }
    .route {
        margin-top: 1rem;
    }
}

.route {
    text-decoration: none;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
}
.icon{
    width:2.5rem;
    margin-right: 48rem;
}

.register{
    background-color: var(--vt-c-black-contrast);
    color: var(--vt-c-black);
    font-weight: 500;
}


.route:hover {
    background-color: var(--vt-c-black-contrast);
    color: var(--vt-c-black);
    font-weight: bold;
}
.route:focus,
.route:focus-visible {
    outline: 2px solid var(--vt-c-black-contrast);
}
.register:hover{
    background-color: var(--vt-c-black-soft);
    color: var(--vt-c-black-contrast);
    font-weight: bold;
}
</style>
  