<script>
import PrivateLayout from './components/shared/layouts/Private.vue';
import PublicLayout from './components/shared/layouts/Public.vue';
import { store } from './context/UserContext.js';

export default {
    components: {
        PrivateLayout,
        PublicLayout
    }, 
    computed: {
        isLoggedIn() {
            return store.isLoggedIn;
        },
    },
}
</script>

<template>
        <PrivateLayout v-if="isLoggedIn" />
        <PublicLayout v-else />
    
</template>

<style scoped>
.logo {
    height: 6em;
    padding: 1.5em;
    will-change: filter;
    transition: filter 300ms;
}

.logo:hover {
    filter: drop-shadow(0 0 2em #646cffaa);
}

.logo.vue:hover {
    filter: drop-shadow(0 0 2em #42b883aa);
}
</style>
