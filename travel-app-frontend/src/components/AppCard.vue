<script>
export default {
  name: "AppCard",
  components: {},
  props: {
    trip: Object,
  },
  methods: {
    getImageUrl(imageName) {
      if (imageName) {
        return `http://localhost/travel-app/travel-app-backend/api/uploads/${imageName}`;
      }
      return "http://localhost/travel-app/travel-app-backend/api/uploads/picture.svg"; // Immagine di default se non c'è cover
    },
  },
};
</script>
<template>
  <router-link class="my-4" :to="{ name: 'trip', params: { id: trip.id } }">
    <div class="card rounded-4 overflow-hidden border-0 text-bg-dark">
      <img :src="getImageUrl(trip.cover)" :alt="`${trip.title}`" />

      <div class="card-img-overlay d-flex align-items-end">
        <div class="box">
          <h5 class="card-title fw-bold m-0">{{ trip.title }}</h5>
          <p class="card-text">
            <small class="trip-date">{{ trip.start_date }}</small>
          </p>
        </div>
      </div>
    </div>
  </router-link>
</template>
<style lang="scss">
.card-title,
.trip-date {
  text-shadow: 0px 0px 10px black;
}
</style>
