<template>
  <component v-bind:is="layout">
    <!-- <router-view :layout.sync="AppLayout" /> -->
  </component>
</template>

<script>
import AppLayout from "./layouts/AppLayout";
import SimpleLayout from "./layouts/SimpleLayout";

export default {
  computed: {
    layout() {
      return this.$store.getters.layout;
    }
  },
  created: function() {
    this.$store.commit("SET_LAYOUT", "app-layout");
    this.$store.commit("SET_LAYOUT", "simple-layout");
  },
  components: {
    "app-layout": AppLayout,
    "simple-layout": SimpleLayout
    // define as many layouts you want for the application
  }
};
</script>
