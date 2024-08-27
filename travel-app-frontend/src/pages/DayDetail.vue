<script>
import axios from "axios";
import { store } from "../store.js";
import AppCardStage from "../components/AppCardStage.vue";
export default {
  components: {
    AppCardStage,
  },

  data() {
    return {
      single_day: "",
      dayID: "",
      currentTripID: localStorage.getItem("CurrTripID"),
      store,
    };
  },

  created() {
    this.dayID = this.$route.params.id;
    localStorage.setItem("currentDayID", this.dayID);
    axios
      .get(
        "http://localhost/travel-app/travel-app-backend/api/trips.php?id=" +
          this.currentTripID +
          "&day=" +
          this.dayID
      )
      .then((response) => {
        this.single_day = response.data;
        console.log(this.single_day);
      });
  },
};
</script>
<template>
  <div class="container">
    <AppCardStage
      v-for="stage in single_day.stages"
      :stage="stage"
    ></AppCardStage>
  </div>
</template>
<style></style>
