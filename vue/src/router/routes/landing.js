import KasheerLayout from "@/layouts/KasheerLayout.vue";

export const landing = [
  {
    path: "/",
    name: "Kashear",
    component: KasheerLayout,
    children: [
      {
        path: "",
        name: "home",
        component: () => import("@/views/HomeView.vue"),
      },
      {
        path: "/pricing",
        name: "pricing",
        component: () => import("@/views/PricingView.vue"),
      },
      {
        path: "/contact",
        name: "contact",
        component: () => import("@/views/ContactView.vue"),
      },
      {
        path: "/about",
        name: "about",
        component: () => import("@/views/AboutView.vue"),
      },
      {
        path: "/news",
        name: "news",
        component: () => import("@/views/OurWorkNews.vue"),
      },
    ],
  },
];
