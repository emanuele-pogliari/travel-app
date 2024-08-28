import { createRouter, createWebHistory } from "vue-router";

import HomePage from "./pages/HomePage.vue";
import AddTrip from "./pages/AddTrip.vue";
import TripDetail from "./pages/TripDetail.vue";
import DayDetail from "./pages/DayDetail.vue";
import SingleStage from "./pages/SingleStage.vue";
import AddStage from "./pages/AddStage.vue";

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
      path: "/day/:id",
      name: "day",
      component: DayDetail,
    },
    {
      path: "/stage/:id",
      name: "stage",
      component: SingleStage,
    },

    {
      path: "/add-trip",
      name: "AddTrip",
      component: AddTrip,
    },
    {
      path: "/add-stage",
      name: "AddStage",
      component: AddStage,
    },
  ],
});

export { router };
