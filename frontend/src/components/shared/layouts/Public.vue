<template lang="">
    <main class="main">
        <Navbar />
            
                <router-view />
        <Footer />
    </main>
</template>
<script>

import Navbar from '../Navbar.vue';
import Footer from '../Footer.vue';
export default {
    components: {
        Navbar,
        Footer,
    }
}
</script>
<style scoped>
    .main{
        width: 100%;
        height: 100%;
    }
</style>