// ExampleComponent.vue
<template>
  <div>
    <p>{{ $store }}</p>
  </div>
</template>

<script>
export default {
  methods: {
    updateGlobalState() {
      this.$store.commit('updateGlobalVariable', 'New value');
    },
  },
};
</script>
