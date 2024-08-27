<script>
export default {
  name: "AppCardDays",
  props: {
    stage: Object,
  },
  components: {},
};
</script>

<template>
  <router-link :to="{ name: 'stage', params: { id: stage.id } }">
    <div class="card rounded-4 overflow-hidden border-0 text-bg-dark">
      <img
        src="https://content.skyscnr.com/m/320898bd38522de1/original/GettyImages-111789813_doc.jpg?resize=1800px:1800px&quality=100"
        class="card-img"
        alt=""
      />
      <div
        class="card-img-overlay d-flex justify-content-center align-items-center"
      >
        <div class="box text-center">
          <h3 class="card-title fw-bold mb-2">{{ stage.title }}</h3>
        </div>
      </div>
    </div>
  </router-link>
</template>
<style lang="scss" scoped>
.card-title {
  font-size: 5rem;
  text-shadow: 0px 0px 10px black;
}
</style>
