<script>
import axios from "axios";
import { store } from "../store.js";
import AppCardDays from "../components/AppCardDays.vue";
import AppUpNav from "../components/AppUpNav.vue";

export default {
  name: "TripDetail",
  components: {
    AppCardDays,
    AppUpNav,
  },
  data() {
    return {
      tripID: "",
      single_trip: "",
    };
  },
  created() {
    this.tripID = this.$route.params.id;
    console.log(this.tripID);
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
              window.location.href = `http://localhost:5173/trip/${this.tripID}`;
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
    <AppUpNav></AppUpNav>
    <AppCardDays
      v-for="day in single_trip.days"
      :day="day"
      class="mb-5"
    ></AppCardDays>
    <div class="d-flex justify-content-end">
      <router-link
        :to="{ name: 'EditTrip', params: { id: this.single_trip.id } }"
      >
        Modifica viaggio
      </router-link>
      <button @click="deleteTrip" class="btn btn-danger">
        Elimina viaggio
      </button>
    </div>
  </div>
</template>
<style></style>
