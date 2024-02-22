<template>
    <nav class="navbar">
        <!-- TODO: Implement a list structure here to contain the links-->
        <router-link class="route" to="/">Home</router-link>
        <router-link class="route" to="/contact">Contact</router-link>
        <router-link class="route" to="/home">Events</router-link>
        <router-link v-if="!isLoggedIn" class="route" to="/login">Login</router-link>
        <router-link v-if="!isLoggedIn" class="route" to="/register">Register</router-link>
        <router-link v-else class="route" to="/user">User</router-link>
    </nav>
</template>

<script>
import { useAuthStore } from '../../store/UserStore.js';

export default {
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
    width: 100%;
    justify-content: space-around;
    align-items: center;
    color: white;
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
.route:hover {
    background-color: var(--vt-c-black-contrast);
    color: var(--vt-c-black);
    font-weight: bold;
}
.route:focus,
.route:focus-visible {
    outline: 2px solid var(--vt-c-black-contrast);
}
</style>
  