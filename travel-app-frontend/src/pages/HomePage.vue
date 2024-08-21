<script>
import AppMainContent from "../components/AppMainContent.vue";
import AppNav from "../components/AppNav.vue";
export default {
  name: "HomePage",

  components: {
    AppMainContent,
    AppNav,
  },
};
</script>

<template>
  <div class="container">
    <div class="d-flex flex-column">
      <h1 class="my-3">Home</h1>
      <AppMainContent></AppMainContent>
      <AppNav></AppNav>
    </div>
  </div>
</template>

<style lang="scss"></style>
