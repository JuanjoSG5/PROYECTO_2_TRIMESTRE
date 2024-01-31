<script setup>
import { ref, computed } from 'vue'
import LandingPage from '../pages/LandingPage.vue';
import SignUpPage from '../pages/SignUpPage.vue';
import NotFound from '../pages/NotFound.vue';
const routes = {
  '/': LandingPage,
  '/login': LoginPage,
  '/signup': SignUpPage,
  '/profile': ProfilePage,
  '/notfound': NotFound,
  '/main': MainPage,
}

const currentPath = ref(window.location.hash)

window.addEventListener('hashchange', () => {
  currentPath.value = window.location.hash
})

const currentView = computed(() => {
  return routes[currentPath.value.slice(1) || '/'] || NotFound
})
</script>

<template>
    <a href="#/">Home</a> |
    <a href="#/about">About</a> |
    <a href="#/non-existent-path">Broken Link</a>
    <component :is="currentView" />
  </template>