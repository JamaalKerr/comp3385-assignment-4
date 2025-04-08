<template>
    <form id="movieForm" @submit.prevent="saveMovie">
      <div class="form-group">
        <label for="title">Title:</label>
        <input v-model="title" type="text" name="title" class="form-control" required />
      </div>
      
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea v-model="description" name="description" class="form-control" required></textarea>
      </div>
  
      <div class="form-group">
        <label for="poster">Poster:</label>
        <input type="file" @change="handleFileUpload" class="form-control" />
      </div>
  
      <div v-if="message" class="alert" :class="error ? 'alert-danger' : 'alert-success'">
        {{ message }}
      </div>
  
      <button type="submit">Add Movie</button>
    </form>
  </template>
  
  <script>
  export default {
    data() {
      return { title: "", description: "", poster: null, message: "", error: false };
    },
    methods: {
      handleFileUpload(event) {
        this.poster = event.target.files[0];
      },
      async saveMovie() {
        let movieForm = document.getElementById('movieForm');
        let formData = new FormData(movieForm);
  
        try {
          let response = await fetch("/api/v1/movies", {
            method: "POST",
            headers: { "Accept": "application/json" },
            body: formData,
          });
  
          let data = await response.json();
          if (response.ok) {
            this.message = data.message;
            this.error = false;
          } else {
            this.message = data.errors ? Object.values(data.errors).join(' ') : "An error occurred.";
            this.error = true;
          }
        } catch (error) {
          this.message = "Network error.";
          this.error = true;
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
  