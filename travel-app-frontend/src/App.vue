<script>
import HelloWorld from "./components/AppNav.vue";
import AppNav from "./components/AppNav.vue";
import axios from "axios";

export default {
  components: {
    HelloWorld,
  },
  data() {
    return {
      trip: [],
    };
  },
};
</script>

<template>
  <router-view></router-view>
</template>

<style lang="scss"></style>
