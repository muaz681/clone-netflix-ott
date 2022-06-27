<template>
  <div
    ref="container"
    class="
      cursor-pointer
      video-card
      relative
      transition-all
      duration-300
      image-cart-hover
    "
    :class="{
      'animate-card-hover': hover,
      'animate-card-unhover': !hover,
    }"
    @mouseover="hover = true"
    @mouseleave="hover = false"
  >
  <a :href="$site_url + local + '/details/' + sdata.slug">
    <img
      :size="185"
      :class="{ 'rounded-b-none shadow': hover }"
      alt="Image"
      :src="getFile(sdata.featured_l.small)"
      v-if="sdata.featured_l && sdata.featured_l.small"
    />
    <img
      :data-original="$asset_url + $noimage"
      :src="$asset_url + $noimage"
      alt="No Image"
      class="img-fluid"
      v-else
    />
    </a>
    <div
      v-if="hover"
      class="
        absolute
        top-full
        w-full
        h-26
        black
        rounded-b-md
        transition-all
        duration-300
        shadow
        space-y-2
        text-white
        cinebaz-img-hvr
      "
      :class="[!hover ? 'invisible opacity-0' : 'visible opacity-100']"
    >
      <div class="flex items-center justify-between hover-part-image">
        <div class="flex items-center">
          <v-btn
            v-if="sdata.video_url != null"
            class="bg-white text-black cinebaz-det-fvrt"
            outlined
            fab
            :href="$site_url + local + '/details/' + sdata.slug"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              width="1.2em"
              height="1.2em"
              preserveAspectRatio="xMidYMid meet"
              viewBox="0 0 256 256"
              class="text-xs"
              data-v-6a5f5389=""
            >
              <path
                d="M239.969 128a15.9 15.9 0 0 1-7.656 13.656l-143.97 87.985A15.998 15.998 0 0 1 64 215.992V40.008a15.998 15.998 0 0 1 24.344-13.649l143.969 87.985A15.9 15.9 0 0 1 239.969 128z"
                fill="currentColor"
              ></path>
            </svg>
          </v-btn>
          <v-btn
            class="items-center text-white justify-center cinebaz-det-fvrt"
            outlined
            fab
            color="white"
            @click="addListing(sdata.id)"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              width="1.2em"
              height="1.2em"
              preserveAspectRatio="xMidYMid meet"
              viewBox="0 0 24 24"
              class="text-xs"
              data-v-6a5f5389=""
            >
              <path
                d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z"
                fill="currentColor"
              ></path>
            </svg>
          </v-btn>
          <v-btn
            class="items-center text-white justify-center cinebaz-det-fvrt"
            outlined
            fab
            color="white"
            @click="addFavorite(sdata.id)"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              preserveAspectRatio="xMidYMid meet"
              width="1.2em"
              height="1.2em"
              viewBox="0 0 471.701 471.701"
              class="text-xs"
            >
              <path
                d="M433.601,67.001c-24.7-24.7-57.4-38.2-92.3-38.2s-67.7,13.6-92.4,38.3l-12.9,12.9l-13.1-13.1
		c-24.7-24.7-57.6-38.4-92.5-38.4c-34.8,0-67.6,13.6-92.2,38.2c-24.7,24.7-38.3,57.5-38.2,92.4c0,34.9,13.7,67.6,38.4,92.3
		l187.8,187.8c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-3.9l188.2-187.5c24.7-24.7,38.3-57.5,38.3-92.4
		C471.801,124.501,458.301,91.701,433.601,67.001z M414.401,232.701l-178.7,178l-178.3-178.3c-19.6-19.6-30.4-45.6-30.4-73.3
		s10.7-53.7,30.3-73.2c19.5-19.5,45.5-30.3,73.1-30.3c27.7,0,53.8,10.8,73.4,30.4l22.6,22.6c5.3,5.3,13.8,5.3,19.1,0l22.4-22.4
		c19.6-19.6,45.7-30.4,73.3-30.4c27.6,0,53.6,10.8,73.2,30.3c19.6,19.6,30.3,45.6,30.3,73.3
		C444.801,187.101,434.001,213.101,414.401,232.701z"
                fill="currentColor"
              ></path>
            </svg>
          </v-btn>
          <v-btn
            v-if="sdata.premium == 1 && sdata.published_at != null"
            class="items-center text-white justify-center cinebaz-det-fvrt"
            outlined
            fab
            color="white"
            @click="AddToCart(sdata.id)"
          >
            <svg
              aria-hidden="true"
              focusable="false"
              data-prefix="fas"
              data-icon="cart-plus"
              class="svg-inline--fa fa-w-18 text-xs"
              role="img"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 576 512"
              width="1.2em"
              height="1.2em"
            >
              <path
                fill="currentColor"
                d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z"
              ></path>
            </svg>
          </v-btn>
          
          
        </div>
        <v-btn
          class="price-btn items-center text-white justify-center"
          color="white"
          v-if="sdata.premium == 1 && sdata.published_at != null"
        >
          <span class="d-block details-price-page">
            <span class="badge badge-secondary badge-age-limit"
              >{{ paycurrency }} {{ sdata.discount_price }}</span
            >
          </span>
        </v-btn>
      </div>
      <a :href="$site_url + local + '/details/' + sdata.slug">
      <p
        class="
          line-clamp-1
          index-heading
          trending-text
          big-title
          text-uppercase
          mt-0
        "
      >
        {{ sdata.title_en }}
      </p>
      </a>
    </div>
    
  </div>
</template>

<script>
export default {
  props: {
    sdata: {
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
  mounted() {
    // console.log(this.sdata);
  },
  watch: {},
  methods: {
    mouseOver: function () {
      this.active = !this.active;
    },
    getFile: function (file) {
      return this.$asset_url + "storage/" + file;
    },
    AddToCart(id) {
      this.axios.get(this.$site_url + "cart/add/" + id).then((response) => {
        $(".cart_items").html(response.data.content);
        // console.log(response["data"].message);
        // this.$swal({
        //   title: response["data"].message,
        // }).then((result) => {
        //   if (result.needLogin) {
        //     window.location.href = $site_url + local + "/member/login";
        //   }
        // });
      });
    },
    addListing(id) {
      this.axios.get(this.$site_url + "ajax/listing/" + id).then((response) => {
        console.log(response.data);
      });
    },
    addFavorite(id) {
      this.axios
        .get(this.$site_url + "ajax/favorite/" + id)
        .then((response) => {
          console.log(response.data);
        });
    },
  },
};
</script>

<style scoped>
.price-btn {
  background: transparent !important;
  height: 0px !important;
  min-width: 0px !important;
  padding: 0px !important;
}
.index-heading {
  -webkit-line-clamp: 2 !important;
  padding: 10px 5px;
  font-size: 14px;
  line-height: normal;
}
.shadow {
  -webkit-box-shadow: 0px 0px 12px 0px #000000;
  box-shadow: 0px 0px 12px 0px #000000;
}

.video-card img {
  @apply object-cover rounded-md absolute top-0 left-0 w-full h-full;
}

.cinebaz-det-fvrt {
  height: 23px !important;
  width: 23px !important;
  border: 1px solid #fff;
  margin-right: 5px;
  margin-top: 5px;
  line-height: 22px;
  text-align: center;
}
.hover-part-image {
  padding: 0 6px;
}
.image-cart-hover img {
  border: 1px solid #181717;
}
.cinebaz-img-hvr {
  background: #000000;
}
.hover-part-image .text-xs {
  font-size: 11px;
}

@media (max-width:767px){
  .cinebaz-det-fvrt{
    height: 20px !important;
    width: 20px !important;
    margin-right: 3px;
    line-height: 20px;
  }
  .hover-part-image .text-xs {
    font-size: 11px;
    font-size: 9px;
  }
  .details-price-page span {
    font-weight: 500;
    font-size: 8px;
  }
}
</style>