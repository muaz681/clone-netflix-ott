<template>
  <div
    class="carousel-container relative"
    :class="[hover ? 'animate-z-hover' : 'animate-z-unhover']"
    @mouseover="hover = true"
    @mouseleave="hover = false"
  >
    <div class="swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide" v-for="(item, index) in mdata" :key="index">
          <video-card
            :sdata="item"
            :member="member"
            :local="local"
            :paycurrency="paycurrency"
            :movieincart="movieincart"
            :mycart="mycart"
            :totalcart="totalcart"
            :count="count"
          ></video-card>
        </div>
      </div>

      <div class="swiper-pagination"></div>
      <template>
        <div
          class="
            swiper-button swiper-button-prev
            group
            cursor-pointer
            flex
            items-center
            justify-center
          "
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            width="1.2em"
            height="1.2em"
            preserveAspectRatio="xMidYMid meet"
            viewBox="0 0 24 24"
            class="w-10 h-10 group-hover:w-12 group-hover:h-12"
          >
            <path
              d="M17.51 3.87L15.73 2.1L5.84 12l9.9 9.9l1.77-1.77L9.38 12l8.13-8.13z"
              fill="currentColor"
            ></path>
          </svg>
        </div>

        <div
          class="
            swiper-button
            group
            cursor-pointer
            swiper-button-next
            flex
            items-center
            justify-center
          "
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            width="1.2em"
            height="1.2em"
            preserveAspectRatio="xMidYMid meet"
            viewBox="0 0 24 24"
            class="w-10 h-10 group-hover:w-12 group-hover:h-12"
          >
            <path
              d="M6.23 20.23L8 22l10-10L8 2L6.23 3.77L14.46 12z"
              fill="currentColor"
            ></path>
          </svg>
        </div>
      </template>
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
      hover: false,
    };
  },
  watch: {},
  methods: {
    mouseOver: function () {
      this.active = !this.active;
    },
  },
};
</script>
<style>
.swiper {
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
.swiper {
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