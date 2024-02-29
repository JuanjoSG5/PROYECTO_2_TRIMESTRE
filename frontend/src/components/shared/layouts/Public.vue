<template lang="">
    <div class="wrapper">
        <Navbar v-if="showHeader"/>
            <main class="main">
                <router-view />
            </main>
            <div class="container">
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
.wrapper{
    display: grid;
    grid-template-rows: auto 1fr auto;
    box-sizing: border-box;
    min-height:100vh;
    width: 100%;
}
.main {  
    width: 100%;
    height: 100%;
}
.container{
    display:none;
}


@media (max-width: 1024px){
    
    .container {
        position: relative;
        bottom: 0;
        
    }
    .footer {
        position: absolute;
        top: 43rem ;
        height: 5rem;
        background-color: var(--vt-c-black-contrast);
    }
}
</style>