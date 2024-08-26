<script>
export default {
  name: "AppCard",
  components: {},
  props: {
    trip: Object,
  },
};
</script>
<template>
  <router-link :to="{ name: 'trip', params: { id: trip.id } }">
    <div class="card rounded-4 overflow-hidden border-0 text-bg-dark">
      <img :src="trip.cover" class="card-img" alt="" />
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
