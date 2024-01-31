<script setup>
import { ref } from 'vue'

defineProps({
  msg: String,
})

const count = ref(0)
</script>

<template>
  <h1>{{ msg }}</h1>

  <div class="card">
    <h1>{{ count }}</h1>
    <button type="button" @click="count--">-</button>
    
    <button type="button" @click="count++">+</button>
    
    <button type="button" @click="count = 0">reset</button>
  </div>
</template>

<style scoped>
.read-the-docs {
  color: #888;
}
</style>
