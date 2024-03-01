<template>
    <div :class="wrapperClass">
        <Navbar v-if="showHeader"/>
        <main class="main">
            <router-view />
        </main>
        <Footer class="footer" v-if="!this.$route.path.endsWith('/')" />
            <div class="container" v-else>
        <Footer class="footer" v-if="showFooter" />
    </div>
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
.wrapper {
    box-sizing: border-box;
    min-height: 100vh;
    width: 100%;
}

.wrapper-with-grid {
    display: grid;
    grid-template-rows: auto 1fr auto;
}

.main {  
    width: 100%;
    height: 100%;
}

.footer{
    position: relative;
    bottom: 0;
    height: 5rem;
    background-color: var(--vt-c-black-contrast);

}


@media (max-width: 1024px) {
    .container {
        position: relative;
        bottom: 0;
    }
    .footer {
        position: relative;
        height: 5rem;
        background-color: var(--vt-c-black-contrast);
    }
}

@media (max-width: 768px) {
    .container {
        position: relative;
        top: 48rem;
    }
    .footer {
        position: relative;
        height: 5rem;
        background-color: var(--vt-c-black-contrast);
    }
}


</style>
