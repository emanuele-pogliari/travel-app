import { createRouter, createWebHistory } from "vue-router";

import HomePage from "./pages/HomePage.vue";
import AddTrip from "./pages/AddTrip.vue";
import TripDetail from "./pages/TripDetail.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomePage,
    },

    {
      path: "/trip/:id",
      name: "trip",
      component: TripDetail,
    },

    {
      path: "/add-trip",
      name: "AddTrip",
      component: AddTrip,
    },
  ],
});

export { router };
