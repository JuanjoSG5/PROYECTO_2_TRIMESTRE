<script>
import PrivateLayout from './components/shared/layouts/Private.vue';
import PublicLayout from './components/shared/layouts/Public.vue';
import { useAuthStore } from './store/UserStore.js';

export default {
    data() {
        return {
            store: useAuthStore()
        };
    },
    components: {
        PrivateLayout,
        PublicLayout
    }, 
    computed: {
        isLoggedIn() {
            return this.store.username === null;
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
