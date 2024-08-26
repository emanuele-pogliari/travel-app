<script>
export default {
  name: "AppNav",
};
</script>

<template>
  <nav class="sub-nav border-top d-flex me-0">
    <div
      class="text-center nav-item d-flex justify-content-center align-items-center"
    >
      <i class="fa fa-home" aria-hidden="true"></i>
    </div>
    <div
      class="text-center nav-item d-flex justify-content-center align-items-center"
    >
      <router-link :to="{ name: 'AddTrip' }"
        ><i class="fa-solid fa-plus"></i>
      </router-link>
    </div>
    <div
      class="text-center nav-item d-flex justify-content-center align-items-center"
    >
      <i class="fa-solid fa-earth-americas"></i>
    </div>
  </nav>
</template>

<style>
.nav-item {
  width: calc(100% / 3);
  height: 5vh;
}
</style>
