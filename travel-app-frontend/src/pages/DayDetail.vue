<script>
import axios from "axios";
import { store } from "../store.js";
import AppCardStage from "../components/AppCardStage.vue";
import AppUpNav from "../components/AppUpNav.vue";
export default {
  components: {
    AppCardStage,
    AppUpNav,
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
  methods: {
    deleteDay() {
      if (
        confirm(
          "Sei sicuro di voler eliminare questo giorno? Questa azione non può essere annullata."
        )
      ) {
        axios
          .delete(
            "http://localhost/travel-app/travel-app-backend/api/days.php?id=" +
              this.single_day.id
          )
          .then((response) => {
            if (response.data.success) {
              alert("Giorno eliminato con successo!");
              this.upadateNumberOfDays();
              window.location.href = "http://localhost:5173/";
            } else {
              alert("Errore durante l'eliminazione del giorno.");
            }
          })
          .catch((error) => {
            console.error(error);
          });
      }
    },
    upadateNumberOfDays() {
      axios
        .get(
          `http://localhost/travel-app/travel-app-backend/api/trips.php?id=${this.CurrentTripID}`
        )
        .then((res) => {
          const remainingDays = res.data.days.length;
          axios
            .post(
              `http://localhost/travel-app/travel-app-backend/api/trips.php`,
              {
                id: this.currentTripID,
                number_of_days: remainingDays,
                udpdate_days_only: true,
              }
            )
            .then((response) => {
              if (response.data.success) {
                alert("Il numero di giorni è stato aggiornato con successo!");
                window.location.href = "http://localhost:5173/";
              } else {
                alert("Errore durante l'aggiornamento del numero di giorni.");
              }
            })
            .catch((error) => {
              console.error(
                "Errore durante l'aggiornamento del numero di giorni:",
                error
              );
            });
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
<template>
  <div class="container">
    <AppUpNav></AppUpNav>
    <AppCardStage
      v-for="stage in single_day.stages"
      :stage="stage"
    ></AppCardStage>

    <div>
      <router-link
        :to="{ name: 'AddStage', params: { id: this.single_day.id } }"
      >
        <div class="border border-1 border-black px-1 rounded-5">
          <i class="fa-solid fa-plus"></i>
        </div>
      </router-link>
    </div>
    <div class="d-flex justify-content-end">
      <button @click="deleteDay" class="btn btn-danger">Elimina Giorno</button>
    </div>
  </div>
</template>
<style></style>
