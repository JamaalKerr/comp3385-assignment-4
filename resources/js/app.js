import { createApp } from "vue";
import App from "./App.vue"; // Ensure App.vue is the main entry point
import router from "./router"; // Import Vue Router
import MovieList from "./components/MovieList.vue";
import MovieForm from "./components/MovieForm.vue";

const app = createApp(App); // Initialize Vue with App.vue
app.use(router); // Enable Vue Router

// Register components globally (if needed)
app.component("movie-list", MovieList);
app.component("movie-form", MovieForm);

app.mount("#app"); // Mount the app properly
