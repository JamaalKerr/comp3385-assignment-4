import { createApp } from 'vue';
import MovieList from './components/MovieList.vue';
import MovieForm from './components/MovieForm.vue';

const app = createApp({});
app.component('movie-list', MovieList);
app.component('movie-form', MovieForm);
app.mount('#app');
