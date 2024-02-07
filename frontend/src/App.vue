<script >
import PrivateLayout from './components/shared/layouts/Private.vue';
import PublicLayout from './components/shared/layouts/Public.vue';

export default {
  components: {
    PrivateLayout,
    PublicLayout
},
  data(){
    return {
      isLogged: false
    }
  }
}
</script>

<template>
  <section>
    <PrivateLayout v-if="isLogged" />
    <PublicLayout v-else />

  </section>
</template>

<style scoped>
.logo {
  height: 6em;
  padding: 1.5em;
  will-change: filter;
  transition: filter 300ms;
}

.logo:hover {
  filter: drop-shadow(0 0 2em #646cffaa);
}

.logo.vue:hover {
  filter: drop-shadow(0 0 2em #42b883aa);
}
</style>
