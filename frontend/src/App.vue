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
  .main{
        width: 100%;
        height: 100%;
    }
</style>
