<script>
import axios from "axios";
export default {
  data() {
    return {
      stage: "",
      currentTripID: localStorage.getItem("CurrTripID"),
      dayID: localStorage.getItem("currentDayID"),
    };
  },
  created() {
    this.stageID = this.$route.params.id;
    axios
      .get(
        "http://localhost/travel-app/travel-app-backend/api/trips.php?id=" +
          this.currentTripID +
          "&day=" +
          this.dayID +
          "&stage=" +
          this.stageID
      )
      .then((response) => {
        this.stage = response.data;
        console.log(this.stage);
      });
  },
};
</script>
<template>
  <div>
    <ul>
      <li>Titolo: {{ stage.title }}</li>
      <li>Descrizione: {{ stage.description }}</li>
      <li>Location: {{ stage.location }}</li>
      <li>Latitudine: {{ stage.latitude }}</li>
      <li>Longitudine: {{ stage.longitude }}</li>
    </ul>
  </div>
</template>
<style></style>
