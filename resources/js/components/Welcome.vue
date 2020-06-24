<template>
  <div>
    <button color="primary" @click="setLayout('simple-layout')">Simple Layout</button>
    <button color="secondary" @click="setLayout('app-layout')">App Layout</button>
  </div>
</template>

<script>
export default {
  methods: {
    setLayout(layout) {
      this.$store.commit("SET_LAYOUT", layout);
    }
  },
  created: function() {
    this.$store.commit("SET_LAYOUT", "simple-layout");
  }
};
</script>
