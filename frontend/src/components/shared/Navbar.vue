
<template>
    
    <nav class="navbar">
            <router-link class="route" to="/">Home</router-link>
            <router-link class="route" to="/contact">Contact</router-link>
            <router-link class="route" to="/home">Events</router-link>
            <router-link v-if="!isLoggedIn" class="route" to="/login">Login</router-link>
            <router-link v-if="!isLoggedIn" class="route" to="/register">Register</router-link>
            <router-link v-else class="route" to="/user">User</router-link>
    </nav>
</template>
  
<script>
import {store} from '../../context/UserContext.js';
export default {
    computed: {
        isLoggedIn() {
            return store.isLoggedIn;
        },
    },
};
</script>
  
<style scoped>

.navbar {
    display: flex;
    top: 0;
    left: 0;
    margin: 16px;
    width: 100%;
    position: absolute;
    justify-content: space-around;
    
    align-items: center;
    color: white;
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
  