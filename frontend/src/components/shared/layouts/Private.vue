<template>
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
// document.setStyle
</script>
  
<style scoped>

.wrapper{
    display: grid;
    grid-template-columns: auto 1fr auto;
    min-height:100vh;
}
.main {
    position: relative;
    flex: 1 0 auto;
    width: 100%;
    height: 100%;
}
</style>