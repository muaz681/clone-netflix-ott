<template>
  <!-- <div class="container-fluid"> -->
  <v-container>
    <div v-for="(item, index) in mdata" :key="index">
      <div class="space-y-2" v-if="item != null">
        <h1 class="text-xl font-medium font-netflix_medium text-white">
          {{ item.name }}
        </h1>
        <video-carousel :sdata="item" :member="member"></video-carousel>
      </div>
    </div>
  </v-container>
  <!-- </div> -->
</template>

<script>
export default {
  mounted() {
    console.log(this.mdata);
  },
};
</script>

<style>
</style>