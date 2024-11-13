import { landing } from "./landing";
import { auth } from "./auth";

export default [
  ...landing,
  ...auth,
  {
    path: "/check-out/:packageId",
    name: "Checkout",
    component: () => import("@/views/CheckOut.vue"),
  },
  {
    path: "/check-out-2/:packageId",
    name: "Checkout2",
    component: () => import("@/views/CheckOut2.vue"),
  },
  {
    path: "/stripe/:packageId",
    name: "stripe",
    component: () => import("@/views/StripeView.vue"),
  },
  {
    path: "/success",
    name: "Success",
    component: () => import("@/views/Success.vue"),
  },
];
