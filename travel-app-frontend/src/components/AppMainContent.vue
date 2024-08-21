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
  <AppCard v-for="trip in trips" :trip="trip"></AppCard>
</template>

<style></style>
