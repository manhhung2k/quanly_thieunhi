// app.js

require('./bootstrap');

import Vue from 'vue';
import { createApp } from 'vue';
import HotelList from './components/HotelListComponent.vue';
import HotelCreate from './components/HotelCreate.vue';
import HotelEdit from './components/HotelEditComponent.vue';
import '../css/app.css';
import 'toastify-js/src/toastify.css';
const app = createApp({});
app.component('hotel-list', HotelList);
app.component('hotel-create', HotelCreate);
app.component('hotel-edit', HotelEdit);
app.mount('#app');
