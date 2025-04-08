<template>
    <form id="movieForm" @submit.prevent="saveMovie">
        <div class="form-group mb-3">
            <label for="title" class="form-label">Movie Title</label>
            <input v-model="title" type="text" name="title" class="form-control" required />
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea v-model="description" name="description" class="form-control" required></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="poster" class="form-label">Poster</label>
            <input type="file" name="poster" @change="handleFileUpload" class="form-control" required />
        </div>

        <div v-if="message" class="alert" :class="error ? 'alert-danger' : 'alert-success'">
            {{ message }}
        </div>

        <button type="submit" class="btn btn-primary">Add Movie</button>

        <!-- ✅ Button to Submit All Predefined Movies -->
        <button type="button" @click="submitMovies" class="btn btn-success mt-3">
            Add All Movies
        </button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            title: "",
            description: "",
            poster: null,
            message: "",
            error: false,
            movies: [
                {
                    title: "Kraven the Hunter (2024)",
                    description: "Kraven the Hunter follows the infamous Marvel villain as he embarks on a brutal quest.",
                    poster: "kraven-the-hunter_2024.jpg"
                },
                {
                    title: "Moana 2 (2024)",
                    description: "Moana returns for an epic adventure across the seas, discovering new lands and legends.",
                    poster: "moana-2_2024.jpg"
                },
                {
                    title: "Mufasa: The Lion King (2024)",
                    description: "A journey through Mufasa's past, revealing how he became the legendary Lion King.",
                    poster: "mufasa-the-lion-king_2024.jpg"
                },
                {
                    title: "Sonic the Hedgehog 3 (2024)",
                    description: "Sonic faces new villains and unexpected allies in his fastest adventure yet.",
                    poster: "sonic-the-hedgehog-3_2024.jpg"
                },
                {
                    title: "Wicked (2024)",
                    description: "A magical retelling of the Wicked Witch’s journey, revealing the untold story behind Oz.",
                    poster: "wicked_2024.jpg"
                }
            ]
        };
    },
    methods: {
        handleFileUpload(event) {
            this.poster = event.target.files[0];
        },
        async saveMovie() {
            let movieForm = document.getElementById("movieForm");
            let form_data = new FormData(movieForm);

            try {
                let response = await fetch("http://127.0.0.1:8000/api/v1/movies", { 
                    method: "POST",
                    body: form_data,
                    headers: { "Accept": "application/json" }
                });

                let data = await response.json();
                if (response.ok) {
                    this.message = "✅ Movie added successfully!";
                    this.error = false;
                    movieForm.reset(); // Clear form fields on success
                } else {
                    this.message = `❌ Error: ${data.errors ? Object.values(data.errors).join(' ') : "Validation failed."}`;
                    this.error = true;
                }
            } catch (error) {
                this.message = "❌ Network error.";
                this.error = true;
                console.error(error);
            }
        },
        async submitMovies() {
            for (let movie of this.movies) {
                let formData = new FormData();
                formData.append("title", movie.title);
                formData.append("description", movie.description);
                formData.append("poster", `/public/images/${movie.poster}`);

                try {
                    let response = await fetch("http://127.0.0.1:8000/api/v1/movies", {
                        method: "POST",
                        body: formData,
                        headers: { "Accept": "application/json" }
                    });

                    let data = await response.json();
                    if (response.ok) {
                        this.message = `✅ Successfully added ${movie.title}`;
                        this.error = false;
                    } else {
                        this.message = `❌ Error adding ${movie.title}: ${data.message}`;
                        this.error = true;
                    }
                } catch (error) {
                    console.error(`❌ Network error adding ${movie.title}:`, error);
                    this.message = "❌ Network error.";
                    this.error = true;
                }
            }
        }
    }
};
</script>

<style>
.alert {
    margin-top: 10px;
    padding: 10px;
}
.alert-success { background-color: #dff0d8; color: #3c763d; }
.alert-danger { background-color: #f2dede; color: #a94442; }
</style>
