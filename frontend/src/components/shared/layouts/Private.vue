<template>

    <main class="main">
      <Navbar />
        <router-view />
      <Footer v-if="showFooter" />
    </main>
  </template>
  
  <script>
  // TODO: Refactor the html structure since the main is the main cntent of the app 
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
    position: relative;
    width: 100%;
    height: 100%;
  }
  </style>