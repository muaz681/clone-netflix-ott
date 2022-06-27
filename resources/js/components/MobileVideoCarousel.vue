<template>
  <div :class="[sheet ? 'animate-z-hover' : 'animate-z-unhover']"
    @click="sheet = true">
    <div class="mobile_swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide" v-for="(item, index) in mdata" :key="index">
          <mobile-video-card
            :sdata="item"
            :member="member"
            :local="local"
            :paycurrency="paycurrency"
            :movieincart="movieincart"
            :mycart="mycart"
            :totalcart="totalcart"
            :count="count"
          ></mobile-video-card>
        </div>
      </div>
      </div>
      </div>
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
    movieincart: Array,
    paycurrency: String,
    local: String,
    mycart: {
      type: [Object, Array],
    },
    totalcart: String,
    count: String,
  },
  data() {
    return {
      sheet: false,
    };
  },
  watch: {},
  methods: {
  },
};
</script>
<style>
.mobile_swiper {
  width: 100%;
  height: 100%;
}
.swiper-pagination-bullet-active{
      background: #f6931d !important;
}

.swiper-slide {
  text-align: center;
  font-size: 18px;
  background: transparent;
  margin-right: 6px !important;
  /* Center slide text vertically */
  display: -webkit-box;
  display: -ms-flexbox;
  display: -webkit-flex;
  display: flex;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  -webkit-justify-content: center;
  justify-content: center;
  -webkit-box-align: center;
  -ms-flex-align: center;
  -webkit-align-items: center;
  align-items: center;
}

.swiper-slide img {
  display: block;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.mobile_swiper {
  overflow: visible;
}
.swiper-button-disabled {
  display: none;
}
.swiper:hover .swiper-button svg,
.swiper:hover .swiper-pagination {
  visibility: visible;
}
.swiper-button svg {
  visibility: hidden;
}
.swiper-button-next,
.swiper-button-prev {
  @apply absolute h-full w-6 md:w-12 mt-0 top-0 bg-black bg-opacity-50;
  z-index: 2;
}
.swiper-button-prev {
  @apply -left-6 md:-left-12;
}
.swiper-button-next {
  @apply -right-6 md:-right-12;
}
.swiper-pagination {
  @apply space-x-1 w-24 h-0.5 absolute right-0 -top-4 flex invisible;
}
.swiper-pagination-bullet {
  @apply h-full bg-secondary hidden md:block;
  flex: 1 1 0%;
}
.swiper-pagination-bullet-active {
  @apply bg-white;
}
.swiper-button-next:after,
.swiper-container-rtl .swiper-button-prev:after {
  content: none;
}
.swiper-button-prev:after,
.swiper-container-rtl .swiper-button-next:after {
  content: none;
}
.swiper-horizontal > .swiper-pagination-bullets,
.swiper-pagination-bullets.swiper-pagination-horizontal,
.swiper-pagination-custom,
.swiper-pagination-fraction {
  right: 0px;
  width: auto;
  bottom: 100%;
}
.swiper-pagination {
  text-align: right;
}
.swiper-pagination-bullet {
  width: 18px;
  height: 3px;
  display: inline-block;
  border-radius: 0;
}
.mySwiper {
  padding: 10px 0;
}
.carousel-container {
  z-index: 9999999;
}
.swiper-backface-hidden .swiper-slide {
  transform: revert;
}
.swiper-button-next {
  position: absolute;
  right: -100px;
  background: #141414ba;
  width: 6%;
  height: 100%;
  top: 23px;
}
.swiper-button-prev {
  width: 9%;
  height: 100%;
  background: #141414ba;
  position: absolute;
  left: -100px;
  top: 23px;
}
.swiper-button-prev.swiper-button-disabled {
  opacity: -0.65 !important;
}
.swiper-button-next.swiper-button-disabled {
  opacity: -0.65 !important;
}

</style>