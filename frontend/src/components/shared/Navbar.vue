<template>
    <header class="navbar">
        <ul class="navbar-list">
            <router-link class="route icon" to="/"><Icon height="2.5rem"  icon="noto:hourglass-done" /></router-link>
            <router-link class="route" to="/contact">Contact</router-link>
            <router-link v-if="!isLoggedIn" class="route" to="/login">Login</router-link>
            <router-link v-if="!isLoggedIn" class="route register" to="/register">Register</router-link>
            <DarkModeButton  @darkModeChanged="changeColor"/>    
        </ul>
    </header>
</template>

<script>
import { Icon } from '@iconify/vue';
import { useAuthStore } from '../../store/UserStore.js';
import DarkModeButton from './DarkModeButton.vue';

export default {
    components:{
        Icon,
        DarkModeButton
    },
    setup() {
        const store = useAuthStore();

        return {
            isLoggedIn: store.username === null
            
        }
    },
    methods: {
        changeColor() {
            const currentColor = getComputedStyle(document.documentElement).getPropertyValue('--vt-c-black').trim();

            if (currentColor === 'rgb(39, 55, 77)') { 
                document.documentElement.style.setProperty('--vt-c-black', 'rgb(221, 230, 237)');
                document.documentElement.style.setProperty('--vt-c-black-soft', 'rgb(157, 178, 191)');
                document.documentElement.style.setProperty('--vt-c-black-mute', 'rgb(82, 109, 130)');
                document.documentElement.style.setProperty('--vt-c-black-contrast', 'rgb(39, 55, 77)');
            } else {
                document.documentElement.style.setProperty('--vt-c-black', 'rgb(39, 55, 77)');
                document.documentElement.style.setProperty('--vt-c-black-soft', 'rgb(82, 109, 130)');
                document.documentElement.style.setProperty('--vt-c-black-mute', 'rgb(157, 178, 191)');
                document.documentElement.style.setProperty('--vt-c-black-contrast', 'rgb(221, 230, 237)');
            }
        }

    }
};
</script>

  
<style scoped>
.navbar{
    background-color: var(--vt-c-black-contrast);
}

.navbar-list {
    display: flex;
    width: 90%;
    justify-content: space-around;
    align-items: center;
    color: white;
    padding-right: 3rem;
}

.route {
    text-decoration: none;
    background-color: var(--vt-c-black);
    color: var(--vt-c-black-contrast);
    padding: .5rem 1rem;
    border-radius: 5px;
}
.icon{
    background-color: var(--vt-c-black-contrast);
    width:2.5rem;
    margin-right: 32rem;
}

.register{
    background-color: var(--vt-c-black-mute);
    color: var(--vt-c-black);
    font-weight: 600;
}


.route:hover {
    background-color: var(--vt-c-black-soft);
    color: var(--vt-c-black-contrast);
    font-weight: bold;
}
.route:focus,
.route:focus-visible {
    outline: 2px solid var(--vt-c-black);
}
.register:hover{
    background-color: var(--vt-c-black);
    color: var(--vt-c-black-contrast);
    font-weight: bold;
}



@media (max-width: 1440px) {
    .icon{
        margin-right: 16rem;
    }
}

@media (max-width: 1024px) {
    .navbar-list {
        width: 100%;    
        padding: 0;
        justify-content: space-around; 
    }
    .route {
        margin-right: 0rem;
    }
    .icon{
        margin-right: 12rem;
    }
}

@media (max-width: 768px) {
    .navbar-list {
        width: 100%;    
        padding: 0;
        margin: 0;
        justify-content: space-around; /* Change this line */
    }
    .route {
        
        margin-top: 1rem;
    }
    .icon{
        margin-right: 0rem;
    }
}

</style>
  