<!doctype html>
<html lang="en-US">

<head>
    @include('layouts.essential.seo',['seo' => isset($seo)? $seo : null])
    @include('layouts.essential.css')
    @stack('headcss')
    @stack('styles')
</head>

<body>
    {{-- <div id="app"> --}}
    {{-- <script src="{{ mix('/js/app.js') }}"></script> --}}
    <div>

        <!-- loader Start -->
        <div id="loading">
            <div id="loading-center">
            </div>
        </div>
        <!-- loader END -->
        <!-- Header -->
        
        <!-- Header End -->
        
    </div>
    
    <div id="app">
        @include('layouts.essential.header')
        @yield('content')
    </div>
    @include('layouts.essential.footer')
    
    @include('layouts.essential.js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        var swiper = new Swiper(".swiper", {
          slidesPerView: 2,
          spaceBetween: 2,
          slidesPerGroup: 2,
          loopFillGroupWithBlank: false,
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },
          speed: 800,
          watchSlidesProgress: true,
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },
          breakpoints: {
            8000: {
              slidesPerView: 26,
              slidesPerGroup: 4,
            },
            6000: {
              slidesPerView: 20,
              slidesPerGroup: 4,
            },
            4000: {
              slidesPerView: 14,
              slidesPerGroup: 4,
            },
            2900: {
              slidesPerView: 10,
              slidesPerGroup: 4,
            },
            2600: {
              slidesPerView: 9,
              slidesPerGroup: 4,
            },
            2400: {
              slidesPerView: 8,
              slidesPerGroup: 4,
            },
            2200: {
              slidesPerView: 7,
              slidesPerGroup: 4,
            },
            2000: {
              slidesPerView: 7,
              slidesPerGroup: 6,
            },
            1280: {
              slidesPerView: 5,
              slidesPerGroup: 4,
            },
            1024: {
              slidesPerView: 5,
              slidesPerGroup: 3,
            },
            768: {
              slidesPerView: 5,
              slidesPerGroup: 2,
              spaceBetween: 3,
            },
            640: {
              slidesPerView: 4,
              slidesPerGroup: 3,
              spaceBetween: 2,
            },
            480: {
              slidesPerView: 3,
              slidesPerGroup: 3,
            },
          },
        });
    </script>

<script>
  var swiper = new Swiper(".mobile_swiper", {
    slidesPerView: 3,
    spaceBetween: 2,
    slidesPerGroup: 2,
    loopFillGroupWithBlank: false,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    speed: 800,
    watchSlidesProgress: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      768: {
        slidesPerView: 5,
        slidesPerGroup: 2,
        spaceBetween: 3,
      },
      640: {
        slidesPerView: 4,
        slidesPerGroup: 3,
        spaceBetween: 2,
      },
      480: {
        slidesPerView: 3,
        slidesPerGroup: 3,
      },
    },
  });
</script>
    
    <script>
        var height = $(window).height();
        var width = $(window).width();
        console.log('Width : ' + width + 'Px');
    </script>
    <script>
        function addListing(id) {
            $('.list' + id).toggleClass('active');
            $.ajax({
                url: "{{ url('frontend/ajax/listing') }}" + '/' + id,
                success: function(result) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Successfully Done!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });
        }
        function addFavorite(id) {
            $('.fev' + id).toggleClass('active');
            $.ajax({
                url: "{{ url('frontend/ajax/favorite') }}" + '/' + id,
                type: 'get',
                success: function(result) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Successfully Done!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });
        }
    </script>

    <script>
        $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
        });
    </script>
    <script>
        $(".exampleInputPassword2").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
        });
    </script>
    <script>
        $(".addtocart").click(function(){
            $(".pretext").text("Cart Added");
            $('.addtocart').css('background-color', '#555353');
        });
        function AddToCart(id) {
            $.ajax({
                url: "{{ url('/cart/add/') }}" + '/' + id,
                type: 'get',
                success: function(result) {
                    $('.cart_items').html(result.content);
                    console.log(result.content);
                    setTimeout("$('.laraNoti').fadeOut('slow')", 2000);
                    if (result.needLogin) {
                        window.location.href = "{{ route('member.auth.showlogin', app()->getLocale()) }}";
                    }
                }
            });
        }
    </script>
    <script>
        $('body').tooltip({
            selector: '.tip',
            html: true,
            placement: 'auto',
            title: function() {

                return $('#' + $(this).data('tip')).html()
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
