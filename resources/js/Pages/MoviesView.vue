<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
let movies = ref([]);
let errorMessage = ref("");

const fetchMovies = async () => {
    let token = localStorage.getItem("jwt_token");

    if (!token) {
        errorMessage.value = "❌ You are not authenticated. Redirecting to login...";
        setTimeout(() => router.push("/login"), 2000); // ✅ Redirect if no token exists
        return;
    }

    try {
        let response = await fetch("http://127.0.0.1:8000/api/v1/movies", {
            method: "GET",
            headers: {
                "Accept": "application/json",
                "Authorization": "Bearer " + token // ✅ Correct token key
            }
        });

        if (response.status === 401) {
            errorMessage.value = "❌ Session expired. Please log in again.";
            localStorage.removeItem("jwt_token"); // ✅ Clear invalid token
            setTimeout(() => router.push("/login"), 2000);
            return;
        }

        let data = await response.json();
        
        if (response.ok) {
            movies.value = data.movies; // ✅ Update movies array with API response
        } else {
            errorMessage.value = `❌ Error: ${data.message}`;
            console.error("Error fetching movies:", data.message);
        }
    } catch (error) {
        errorMessage.value = "❌ Network error fetching movies.";
        console.error("Network error:", error);
    }
};

// ✅ Fetch movies when component is mounted
onMounted(fetchMovies);
</script>
