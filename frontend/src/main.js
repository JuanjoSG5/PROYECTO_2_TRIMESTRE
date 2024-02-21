import './assets/main.css'
import { createApp } from 'vue';
import router from './router/router';
import App from './App.vue';
import $ from 'jquery';
import { createPinia } from 'pinia'
import piniaPersist from 'pinia-plugin-persist'

const pinia = createPinia()

pinia.use(piniaPersist)

const app = createApp(App);

app.use(pinia)
app.use(router)
app.mount('#app');


