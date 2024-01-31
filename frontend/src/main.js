// main.js or main.ts
import { createApp } from 'vue';
import App from './App.vue';
import UserContext from './context/UserContext.js';

const app = createApp(App);

app.use(UserContext);

app.mount('#app');
