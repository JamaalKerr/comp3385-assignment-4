import { createRouter, createWebHistory } from 'vue-router';
import HomeView from "../Pages/HomeView.vue";
import AboutView from "../Pages/AboutView.vue";
import MoviesView from "../Pages/MoviesView.vue"; // Movie list page
import AddMovieView from "../Pages/AddMovieView.vue";
import LoginView from "../Pages/LoginView.vue"; // Login page

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        { path: '/', component: HomeView },
        { path: '/about', component: AboutView },
        { path: '/movies', component: MoviesView }, // Display all movies
        { path: '/movies/create', component: AddMovieView }, // Add a new movie
        { path: '/login', component: LoginView } // Login route added ✅
    ]
});

export default router;
