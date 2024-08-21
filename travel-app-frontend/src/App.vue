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
  created() {
    axios
      .get("http://localhost/travel-app/travel-app-backend/api/trips.php")
      .then((response) => {
        console.log(response.data);
        this.trip = response.data;
      });
  },
};
</script>

<template>
  <router-view></router-view>
</template>

<style lang="scss"></style>
