import "vuetify/styles";
import "@mdi/font/css/materialdesignicons.css";
import "vuetify/styles";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import { createVuetify } from "vuetify";

export const useVuetify = (app) => {
  const vuetify = createVuetify({
    components,
    directives,
    defaults: {
      global: {
        ripple: true,
      },
      VTextField: {
        variant: "outlined",
        density: "comfortable",
        color: "blue",
      },
      VSelect: {
        variant: "outlined",
        density: "comfortable",
        color: "blue",
      },
      VBtn: {
        rounded: "md",
        color: "#fff",
      },
      VDataTable: {
        showSelect: true,
        hideDefaultFooter: true,
      },
      VPagination: {
        pageCount: 1,
      },
    },
  });

  app.use(vuetify);
};
