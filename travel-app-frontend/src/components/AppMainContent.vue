<script>
import axios from "axios";
import AppCard from "./AppCard.vue";

export default {
  components: {
    AppCard,
  },

  data() {
    return {
      trips: [],
    };
  },

  created() {
    axios
      .get("http://localhost/travel-app/travel-app-backend/api/trips.php")
      .then((response) => {
        console.log(response.data);
        this.trips = response.data;
      });
  },
};
</script>

<template>
  <div class="main-section">
    <AppCard v-for="trip in trips" :trip="trip"></AppCard>
  </div>
</template>

<style lang="scss">
.main-section {
  height: 87vh;
  overflow: auto;
}
</style>
