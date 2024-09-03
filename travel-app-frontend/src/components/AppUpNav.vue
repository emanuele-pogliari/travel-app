<script></script>
<template>
  <div class="d-flex flex-column">
    <h1 v-if="$route.name == 'home'" class="up-nav fw-bold m-0 py-4">Home</h1>
    <a v-if="$route.name != 'home'" @click="$router.back()">back</a>
  </div>
</template>
<style></style>
