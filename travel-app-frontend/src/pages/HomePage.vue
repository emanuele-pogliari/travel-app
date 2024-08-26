<script>
import AppMainContent from "../components/AppMainContent.vue";
import AppNav from "../components/AppNav.vue";
import AppUpNav from "../components/AppUpNav.vue";

export default {
  name: "HomePage",

  components: {
    AppUpNav, // Up navigation bar
    AppMainContent,
    AppNav,
  },
};
</script>

<template>
  <div class="container">
    <AppUpNav></AppUpNav>
    <AppMainContent></AppMainContent>
  </div>
  <AppNav></AppNav>
</template>

<style lang="scss">
.up-nav {
  height: 8vh;
}
</style>
