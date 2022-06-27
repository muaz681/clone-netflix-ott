<template>
  <div class="container">
    <a href="#" class="search-toggle position-relative">
      <i class="fa fa-shopping-cart" style="font-size: 21px"></i>

      <span
        v-if="count"
        class="bg-danger cart_count"
        style="
          height: 15px;
          width: 15px;
          font-size: 10px;
          text-align: center;
          padding: 2px;
          position: absolute;
          top: -5px;
          right: 0px;
          border-radius: 50%;
          line-height: 11px;
        "
      >
        {{ count }}
      </span>
    </a>
    <div class="iq-sub-dropdown">
      <div class="iq-card shadow-none m-0">
        <div class="iq-card-body">
          <!-- @foreach (MyCart() as $cart) -->
          <a
            href="#"
            class="iq-sub-card"
            style="background-color: #323131"
            v-for="(cart, index) in mycart"
            :key="index"
          >
            <div class="media align-items-center">
              <img
                :src="getFile(cart.associatedModel.featured.small)"
                class="img-fluid mr-3"
                alt="cinebaz"
                style="width: 40px"
              />
              <div class="media-body">
                <h6 class="mb-0">{{ cart.name }}</h6>
                <small class="font-size-12">
                  <!-- Price : 10 tk -->
                  BDT {{ cart.price }}
                </small>
              </div>
            </div>
          </a>
          <!-- @endforeach -->
          <a href="#" class="iq-sub-card" style="background-color: #323131">
            <div class="media align-items-center">
              <div
                class="media-body pull-right"
                style="text-align: right; float: right"
              >
                <span
                  ><span class="mb-0">Total Price :</span>
                  <small style="font-size: 15px">
                    <!-- 10tk -->
                    {{ paycurrency }} {{ totalcart }}
                  </small></span
                >
              </div>
            </div>
          </a>
        </div>
        <div class="iq-card-footer">
          <!-- @if (CountMyCart() > 0) -->
          <a
            v-if="count > 0"
            :href="$site_url + local + '/cart/checkout'"
            class="btn btn-hover btn-block"
          >
            Checkout
          </a>
          <!-- @else -->
          <button v-else class="btn btn-hover btn-block" disabled>
            Oops! Purchase is Empty.
          </button>
          <!-- @endif -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    member: {
      type: [Object, Array],
    },
    mycart: {
      type: [Object, Array],
    },
    totalcart: String,
    count: String,
    paycurrency: String,
    local: String,
  },
  data() {
    return {};
  },
  mounted() {
    // console.log(this.mycart);
  },

  methods: {
    getFile: function (file) {
      return this.$asset_url + "storage/" + file;
    },
  },
};
</script>
