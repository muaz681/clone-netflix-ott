@isset($slider['data'])
    @if (count($slider['data']) > 0)
        <div class="container-fluid py-3">
            <div class="row slide-padd">
              <div class="col-md-12">
                  <h1 class="text-xl font-medium font-netflix_medium text-white">
                    <a href="javascript:void(0);">{{ isset($slider['name']) ? __($slider['name']) : null }}</a>
                  </h1>
                  @php
                      $movie_in_cart = [];
                      foreach (MyCart() as $cart) {
                          array_push($movie_in_cart, $cart->name);
                      }
                  @endphp
                  @isset($slider['data'])
                    <mobile-video-carousel :mdata="{{ $slider['data']->toJson() }}"
                        :member="{{ auth('member')->user() ? auth('member')->user() : '{}' }}"
                        paycurrency="{{ PayCurrency() }}"
                        local="{{ app()->getLocale() }}"
                        :movieincart="{{ json_encode($movie_in_cart) }}"
                        :mycart="{{ MyCart() }}"
                        totalcart="{{ MyCartTotal() }}"
                        count="{{ CountMyCart()}}"
                        ></mobile-video-carousel>
                  @endisset
              </div>
            </div>
        </div>
    @endif
@endisset


