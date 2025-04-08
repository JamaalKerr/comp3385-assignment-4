<template>
    <div>
      <h1>Movie List</h1>
      <div v-if="movies.length === 0">No movies found.</div>
      <div v-else>
        <div v-for="movie in movies" :key="movie.id" class="movie">
          <img :src="movie.poster" :alt="movie.title" />
          <h2>{{ movie.title }}</h2>
          <p>{{ movie.description }}</p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return { movies: [] };
    },
    mounted() {
      fetch("/api/v1/movies")
        .then(response => response.json())
        .then(data => { this.movies = data.movies; })
        .catch(error => console.error("Error fetching movies:", error));
    }
  };
  </script>
  
  <style>
  .movie {
    border: 1px solid #ddd;
    padding: 15px;
    margin-bottom: 10px;
  }
  </style>
  