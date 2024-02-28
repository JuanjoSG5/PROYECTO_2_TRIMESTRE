<template lang="">
    <div class="wrapper">
        <Navbar v-if="showHeader"/>
            <main class="main">
                <router-view />
            </main>
        <Footer v-if="showFooter" />
    </div>
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
        showHeader() {
            return this.$route.meta.showHeader;
        },
    },

}
</script>

<style scoped>
.wrapper{
    display: grid;
    grid-template-rows: auto 1fr auto;
    min-height:100vh;
    width: 100%;
}
.main {
    
    width: 100%;
    height: 100%;
}
</style>