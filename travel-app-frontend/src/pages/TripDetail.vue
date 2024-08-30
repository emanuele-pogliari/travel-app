<script>
import axios from "axios";
import { store } from "../store.js";
import AppCardDays from "../components/AppCardDays.vue";

export default {
  name: "TripDetail",
  components: {
    AppCardDays,
  },
  data() {
    return {
      tripID: "",
      single_trip: "",
    };
  },
  created() {
    this.tripID = this.$route.params.id;
    localStorage.setItem("CurrTripID", this.tripID);
    console.log(this.tripID);
    axios
      .get(
        "http://localhost/travel-app/travel-app-backend/api/trips.php?id=" +
          this.tripID
      )
      .then((response) => {
        this.single_trip = response.data;
        console.log(this.single_trip);
      });
  },
  methods: {
    deleteTrip() {
      if (
        confirm(
          "Sei sicuro di voler eliminare questo viaggio? Questa azione non può essere annullata."
        )
      ) {
        axios
          .delete(
            "http://localhost/travel-app/travel-app-backend/api/trips.php?id=" +
              this.tripID
          )
          .then((response) => {
            if (response.data.success) {
              alert("Viaggio eliminato con successo!");
              window.location.href = "http://localhost:5173/";
            } else {
              alert("Errore durante l'eliminazione del viaggio.");
            }
          })
          .catch((error) => {
            console.error(error);
          });
      }
    },
  },
};
</script>
<template>
  <div class="container">
    <h1 class="m-3">{{ single_trip.title }}</h1>
    <AppCardDays
      v-for="day in single_trip.days"
      :day="day"
      class="mb-5"
    ></AppCardDays>
    <div class="d-flex justify-content-end">
      <button @click="deleteTrip" class="btn btn-danger">
        Elimina viaggio
      </button>
    </div>
  </div>
</template>
<style></style>
