<script setup>
import Footer from "~/components/layout/Footer.vue";
import Header from "~/components/layout/Header.vue";
</script>
<template>
  <Header />
  <main>
    <slot />
  </main>
  <Footer />
</template>

<style scoped></style>
