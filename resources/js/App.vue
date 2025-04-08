<script setup>
import Header from "@/components/Header.vue";  // Using `@` alias for better path handling
import Footer from "@/components/Footer.vue";
</script>

<template>
    <Header />
    <main class="container my-5">
        <router-view />
    </main>
    <Footer />
</template>

<style>
html {
    position: relative;
    min-height: 100%;
}

body {
    margin-bottom: 50px; /* Prevents footer overlap */
}

footer {
    position: absolute;
    bottom: 0;
    width: 100%;
}
</style>
