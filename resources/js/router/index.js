import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../Pages/HomeView.vue";
import AboutView from "../Pages/AboutView.vue";
import MoviesView from "../Pages/MoviesView.vue";
import AddMovieView from "../Pages/AddMovieView.vue";
import LoginView from "../Pages/LoginView.vue";

const routes = [
    { path: "/", component: HomeView },
    { path: "/about", component: AboutView },
    { path: "/movies", component: MoviesView },
    { path: "/movies/create", component: AddMovieView },
    { path: "/login", component: LoginView }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
