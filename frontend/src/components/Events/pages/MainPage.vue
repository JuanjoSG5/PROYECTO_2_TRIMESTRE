<template>
    <section :class="[isMenuRetracted ? 'main-event-content' : 'main-content']">
      <LateralMenu :isMenuRetracted="isMenuRetracted" @toggle-menu="toggleMenu" />
      
    </section>
  </template>
  
  <script>
  import LateralMenu from '../components/LateralMenu.vue';
  
  export default {
    components: { LateralMenu },
    data() {
      return {
        isMenuRetracted: false,
      };
    },
    methods: {
      toggleMenu() {
        this.isMenuRetracted = !this.isMenuRetracted;
      },
    },
  };
  </script>
  
  <style scoped>
.main-content {
    display:grid;
    grid-template-columns: 1fr 3fr;
    align-items: center;
    justify-items: center;
    height: 100%;
}
.main-event-content{
    display: grid;
    grid-template-columns: 1fr ;
    height: 100%;
}
  </style>
  