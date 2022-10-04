import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler.js';

import { createPinia } from 'pinia'


import Home from './components/Home.vue';

const app = createApp({});

const pinia = createPinia();

app.component('app-component',Home);

app.use(pinia);

app.mount("#app");
