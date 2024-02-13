<template lang="">
    <Navbar />
        <main>
            <router-view />
        </main>
    <Footer />
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
<style lang="">
    
</style>