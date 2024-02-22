<template lang="">
    <Navbar />
        <main class="main">
            <router-view />
        </main>
    <Footer v-if="showFooter" />
</template>

<script>
import Navbar from '../Navbar.vue';
import Footer from '../Footer.vue';

export default {
    components: {
        Navbar,
        Footer,
    },
    computed: {
        showFooter() {
            return this.$route.meta.showFooter;
        },
    },

}
</script>

<style scoped>
.main {
    width: 100%;
    height: 100%;
}
</style>