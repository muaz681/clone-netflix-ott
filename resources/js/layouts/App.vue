<template>
  <v-app id="inspire">
    <v-main class="grey lighten-2">
      <template>
        <section-container></section-container>
      </template>
    </v-main>
  </v-app>
</template>
<script>
export default {
  props: {
    mdata: {
      type: [Object, Array],
    },
    member: {
      type: [Object, Array],
    },
  },
  mounted() {
    console.log(this.mdata);
  },
};
</script>
<style>
</style>