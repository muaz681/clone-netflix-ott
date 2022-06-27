<header id="main-header">
    <div class="main-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <nav class="navbar navbar-expand-lg navbar-light p-0">
                        <a class="navbar-brand" href="{{ route('frontend.index', app()->getLocale()) }}">
                            @if (isset($setting['site-logo']))
                                <img class="img-fluid logo" src="{{ $setting['site-logo'] }}" alt="cinebaz" />
                            @else
                                <img class="img-fluid logo" src="{{ asset('assets/frontend/images/logo.png') }}"
                                    alt="cinebaz" />
                            @endif
                        </a>
                        <!-- <div class="navbar-right menu-right">
                                    <ul class="d-flex align-items-center list-inline m-0">
                                        <li>
                                            <form action="" method="get">
                                                <div class="input-group">
                                                    <input type="text" class="form-control form-control-sm" placeholder="Search here">
                                                </div>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary btn-sm" type="submit"><i class="fa fa-search"></i></button>
                                                </div>
                                            </form>
                                        </li>
                                    </ul>
                        </div> -->
                        <div class="collapse navbar-collapse" id="navbarToggleExternalContent">
                            <div class="menu-main-menu-container">
                                @if (auth('member')->check())
                                    <a href="{{ route('member.auth.profile', app()->getLocale()) }}"
                                        class="mobile-nav-profile-img">
                                        <div class="manp-image">
                                            @if (isset(auth('member')->user()->images[0]->small))
                                                <img src="{{ url('storage/' . auth('member')->user()->images[0]->small) }}"
                                                    alt="{{ auth('member')->user()->name }}">
                                            @else
                                                <img src="https://visualpharm.com/assets/30/User-595b40b85ba036ed117da56f.svg"
                                                    alt="user" alt="{{ auth('member')->user()->name }}">
                                            @endif
                                        </div>
                                        <div class="manp-name">
                                            <p>{{ auth('member')->user()->name }}</p>
                                            <p>{{ auth('member')->user()->phone }}</p>
                                        </div>
                                    </a>
                                @endif
                                <ul id="top-menu" class="navbar-nav ml-auto">

                                    <li class="menu-item">
                                        <a href="{{ route('frontend.index', app()->getLocale()) }}"><i
                                                class="fa fa-home" aria-hidden="true"></i>
                                            {{ __('Home') }} </a>
                                    </li>
                                    <li class="menu-item">
                                        <a class="dropdown-toggle dropdown-btn" href="javascript:void(0)"><i
                                                class="fa fa-video-camera" aria-hidden="true"></i>
                                            {{ __('tv-show') }}</a>
                                        <div class="dropdown-menu dropdown-container">
                                            <span class="dropdown-span">
                                                <a class="dropdown-item"
                                                    href="{{ route('frontend.tv_show', app()->getLocale()) }}">
                                                    {{ __('all-tv-show') }}</a>
                                            </span>
                                            @foreach (TVShow() as $tvShow_nav)
                                                <span class="dropdown-span">
                                                    <a class="dropdown-item"
                                                        href="{{ route('frontend.media_list', [app()->getLocale(), $tvShow_nav->slug]) }}">{{ $tvShow_nav->title_english }}</a>
                                                </span>
                                            @endforeach
                                        </div>
                                    </li>
                                    <li class="menu-item">
                                        <a class="dropdown-toggle dropdown-btn" href="javascript:void(0)"><i
                                                class="fa fa-film" aria-hidden="true"></i>
                                            {{ __('movies') }}</a>
                                        <div class="dropdown-menu dropdown-container">
                                            <span class="dropdown-span">
                                                <a class="dropdown-item"
                                                    href="{{ route('frontend.movie', app()->getLocale()) }}">{{ __('all-movie') }}</a>
                                            </span>
                                            @foreach (Movies() as $movie_nav)
                                                <span class="dropdown-span">
                                                    <a class="dropdown-item"
                                                        href="{{ route('frontend.media_list', [app()->getLocale(), $movie_nav->slug]) }}">{{ $movie_nav->title_english }}</a>
                                                </span>
                                            @endforeach
                                        </div>
                                    </li>
                                    <li class="menu-item">
                                        <a class="dropdown-toggle dropdown-btn" href="javascript:void(0)"><i
                                                class="fa fa-get-pocket" aria-hidden="true"></i>
                                            {{ __('genre') }}</a>
                                        <div class="dropdown-menu dropdown-container">
                                            @foreach (Gener() as $gener_nav)
                                                <span class="dropdown-span">
                                                    <a class="dropdown-item"
                                                        href="{{ route('frontend.gener.media_list', [app()->getLocale(), $gener_nav->slug]) }}">{{ $gener_nav->title_en }}</a>
                                                </span>
                                            @endforeach
                                        </div>
                                    </li>
                                </ul>
                                <div class="account-profile">
                                    <p>
                                        Profile
                                    </p>
                                </div>
                                <ul id="mobile-nav-item" class="navbar-nav ml-auto">
                                    @if (auth('member')->check())
                                        <li class="menu-item">
                                            <a href="{{ route('member.auth.profile', app()->getLocale()) }}"><i
                                                    class="fa fa-user" aria-hidden="true"></i>
                                                Manage Profile</a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="{{ route('member.auth.library', app()->getLocale()) }}"><i
                                                    class="fa fa-floppy-o" aria-hidden="true"></i>
                                                My Library</a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="{{ route('member.auth.settings', app()->getLocale()) }}"><i
                                                    class="fa fa-wrench" aria-hidden="true"></i>
                                                Settings</a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="{{ route('member.auth.logout', app()->getLocale()) }}"><i
                                                    class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
                                        </li>
                                    @else
                                        <li class="menu-item">
                                            <a href="{{ route('member.auth.register', app()->getLocale()) }}"><i
                                                    class="fa fa-rocket" aria-hidden="true"></i>
                                                Register</a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="{{ route('member.auth.showlogin', app()->getLocale()) }}"><i
                                                    class="fa fa-sign-in" aria-hidden="true"></i>
                                                {{ __('login') }}</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="mobile-more-menu">
                            <div class="navbar-right position-relative">
                                <ul class="d-flex align-items-center justify-content-end list-inline m-0">
                                    {{-- search option --}}
                                    <!-- <li class="nav-item nav-icon">
                                        <a href="#" class="search-toggle device-search">
                                            <i class="ri-search-line"></i>
                                        </a>
                                        <div class="search-box iq-search-bar d-search">
                                            <div class="form-group position-relative goSearchBox">
                                                <input type="text" id="goSearch"class="text search-input font-size-12"
                                                    placeholder="type here to search...">
                                                <i class="search-link ri-search-line"></i>
                                            </div>
                                            <div class="SearchView">
                                            </div>
                                        </div>
                                    </li> -->
                                    {{-- add to cart --}}
                                    <li class="nav-item nav-icon">
                                        <a href="#" class="search-toggle position-relative">
                                            <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22"
                                                height="22" class="noti-svg">
                                                <path fill="none" d="M0 0h24v24H0z" />
                                                <path
                                                    d="M18 10a6 6 0 1 0-12 0v8h12v-8zm2 8.667l.4.533a.5.5 0 0 1-.4.8H4a.5.5 0 0 1-.4-.8l.4-.533V10a8 8 0 1 1 16 0v8.667zM9.5 21h5a2.5 2.5 0 1 1-5 0z" />
                                            </svg> -->
                                            <i class="fa fa-shopping-cart"></i>
                                            @if (CountMyCart())
                                                <span class="bg-danger " style="height: 14px;width: 14px;font-size: 10px;text-align: center;padding: 2px;
                                                                                position: absolute;
                                                                                top: 0px;
                                                                                right: -2px;
                                                                                border-radius: 50%;
                                                                                line-height: 10px;">
                                                    {{ CountMyCart() }}
                                                </span>
                                            @endif
                                        </a>
                                        <div class="iq-sub-dropdown">
                                            <div class="iq-card shadow-none m-0">
                                                <div class="iq-card-body">
                                                    <div class="cart_items">
                                                        @foreach (MyCart() as $cart)
                                                            <a href="#" class="iq-sub-card"
                                                                style="background-color:#323131;">
                                                                <div class="media align-items-center">
                                                                    <img src="{{ asset($cart->associatedModel->featured ? 'storage/' . $cart->associatedModel->featured->small : 'assets/frontend/images/noimage-p.png') }}"
                                                                        class="img-fluid mr-3" alt="cinebaz"
                                                                        style="width:40px;" />
                                                                    <div class="media-body">
                                                                        <h6 class="mb-0 ">{{ $cart->name }}
                                                                        </h6>
                                                                        <small class="font-size-12"> Price
                                                                            :{{ PayCurrency() }}
                                                                            {{ $cart->price }}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                    @if(MyCartTotal() != 0)
                                                        
                                                    
                                                    <a href="#" class="iq-sub-card"
                                                        style="background-color:#323131;">
                                                        <div class="media align-items-center">
                                                            <div class="media-body pull-right"
                                                                style="text-align:right; float:right;">
                                                                <span><span class="mb-0 ">Total Price :</span>
                                                                    <small style="font-size:15px;">
                                                                        {{ PayCurrency() }}
                                                                        {{ MyCartTotal() }} </small></span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    @endif
                                                </div>
                                                @if(MyCartTotal() != 0)
                                                <div class="iq-card-footer">
                                                    @if (CountMyCart() > 0)
                                                        <a href="{{ route('frontend.cart:checkout', [app()->getLocale()]) }}"
                                                            class="btn btn-hover btn-block"> Checkout </a>
                                                    @else
                                                        <button class="btn btn-hover btn-block " disabled>Oops! Purchase
                                                            is Empty. </button>
                                                    @endif
                                                </div>
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="navbar-right menu-right">
                            <ul class="d-flex align-items-center list-inline m-0">
                                <!-- <li>
                                    <a href="#" class="search-toggle">
                                    <i class="ri-search-line"></i>
                                    </a>
                                    <div class="search-box iq-search-bar">
                                        <form action="#" class="searchbox">
                                            <div class="form-group position-relative">
                                            <input type="text" class="text search-input font-size-12"
                                                placeholder="type here to search...">
                                            <i class="search-link ri-search-line"></i>
                                            </div>
                                        </form>
                                    </div>
                                </li> -->
                                <li class="nav-item nav-icon cart_items web-cart">
                                    {{-- CountMyCart() --}}
                                    <add-to-cart :member="{{ auth('member')->user() ? auth('member')->user() : '{}' }}" 
                                        count="{{ CountMyCart()}}"
                                        :mycart="{{ MyCart() }}"
                                        paycurrency="{{ PayCurrency() }}"
                                        local="{{ app()->getLocale() }}"
                                        totalcart="{{ MyCartTotal() }}"
                                        ></add-to-cart>
                                    {{-- <div class="iq-sub-dropdown">
                                        <div class="iq-card shadow-none m-0">
                                            <div class="iq-card-body">
                                            @foreach (MyCart() as $cart)
                                            <a href="#" class="iq-sub-card" style="background-color: #323131">
                                                <div class="media align-items-center">
                                                <img
                                                    src="{{ asset($cart->associatedModel->featured ? 'storage/' . $cart->associatedModel->featured->small : 'assets/frontend/images/noimage-p.png') }}"
                                                    class="img-fluid mr-3"
                                                    alt="cinebaz"
                                                    style="width: 40px"
                                                />
                                                <div class="media-body">
                                                    <h6 class="mb-0">{{ $cart->name }}</h6>
                                                    <small class="font-size-12">
                                                    Price :{{ PayCurrency() }} {{ $cart->price }}
                                                    </small>
                                                </div>
                                                </div>
                                            </a>
                                            @endforeach
                                            <a href="#" class="iq-sub-card" style="background-color: #323131">
                                                <div class="media align-items-center">
                                                <div
                                                    class="media-body pull-right"
                                                    style="text-align: right; float: right"
                                                >
                                                    <span
                                                    ><span class="mb-0">Total Price :</span>
                                                    <small style="font-size: 15px">
                                                        {{ PayCurrency() }} {{ MyCartTotal() }}
                                                    </small></span
                                                    >
                                                </div>
                                                </div>
                                            </a>
                                            </div>
                                            <div class="iq-card-footer">
                                            @if (CountMyCart() > 0)
                                            <a
                                                href="{{ route('frontend.cart:checkout', [app()->getLocale()]) }}"
                                                class="btn btn-hover btn-block"
                                            >
                                                Checkout
                                            </a>
                                            @else
                                            <button class="btn btn-hover btn-block" disabled>
                                                Oops! Purchase is Empty.
                                            </button>
                                            @endif
                                            </div>
                                        </div>
                                    </div> --}}
                                </li>
                                {{-- @if (auth('member')->check())
                                    <li class="nav-item nav-icon">
                                        <a href="#" class="search-toggle position-relative">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22"
                                                height="22" class="noti-svg">
                                                <path fill="none" d="M0 0h24v24H0z" />
                                                <path
                                                    d="M18 10a6 6 0 1 0-12 0v8h12v-8zm2 8.667l.4.533a.5.5 0 0 1-.4.8H4a.5.5 0 0 1-.4-.8l.4-.533V10a8 8 0 1 1 16 0v8.667zM9.5 21h5a2.5 2.5 0 1 1-5 0z" />
                                            </svg>
                                            @if (auth('member')->check())

                                            @endif
                                        </a>
                                        <div class="iq-sub-dropdown">
                                            <div class="iq-card shadow-none m-0">
                                                <div class="iq-card-body">
                                                    @if (auth('member')->check())

                                                        <a href="#" class="iq-sub-card"
                                                            style="background-color:#323131;">
                                                            <div class="media align-items-center">
                                                                <h4>OOps ! No Notification found.</h4>
                                                            </div>
                                                        </a>

                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif --}}
                                <!-- <li class="nav-item nav-icon" >
                                        <a href="#" class="device-search" v-on:click="isActiveSearch()">
                                                <i class="ri-search-line"></i>
                                            </a>


                                    <div class="search-box iq-search-bar d-search">
                                        <div class="form-group position-relative goSearchBox">
                                            <input type="text" id="goSearch"class="text search-input font-size-12"
                                                placeholder="type here to search...">
                                            <i class="search-link ri-search-line"></i>
                                        </div>
                                        <div class="SearchView">
                                        </div>
                                    </div>
                                </li> -->
                                @if (auth('member')->check())
                                    <li class="nav-item nav-icon">
                                        <a href="#"
                                            class="iq-user-dropdown search-toggle p-0 d-flex align-items-center"
                                            data-toggle="search-toggle">
                                            @if (isset(auth('member')->user()->images[0]->small))
                                                <img src="{{ url('storage/' . auth('member')->user()->images[0]->small) }}"
                                                    class="img-fluid avatar-40 rounded-circle" alt="user"
                                                    style="width:20px;height:40px;">
                                            @else
                                            <i class="fas fa-user-circle"></i>
                                            @endif
                                        </a>
                                        <div class="iq-sub-dropdown iq-user-dropdown">
                                            <div class="iq-card shadow-none m-0">
                                                <div class="iq-card-body p-0 pl-3 pr-3">
                                                    <a href="{{ route('member.auth.profile', app()->getLocale()) }}"
                                                        class="iq-sub-card setting-dropdown">
                                                        <div class="media align-items-center">
                                                            <div class="right-icon">
                                                                <i class="ri-file-user-line text-primary"></i>
                                                            </div>
                                                            <div class="media-body ml-3">
                                                                <h6 class="mb-0 ">Manage Profile</h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="{{ route('member.auth.library', app()->getLocale()) }}"
                                                        class="iq-sub-card setting-dropdown">
                                                        <div class="media align-items-center">
                                                            <div class="right-icon">
                                                                <i class="ri-store-line text-primary"></i>
                                                            </div>
                                                            <div class="media-body ml-3">
                                                                <h6 class="mb-0 ">My Library</h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="{{ route('member.auth.bucket', app()->getLocale()) }}"
                                                        class="iq-sub-card setting-dropdown">
                                                        <div class="media align-items-center">
                                                            <div class="right-icon">
                                                                <i class="ri-shopping-cart-2-line text-primary"></i>
                                                            </div>
                                                            <div class="media-body ml-3">
                                                                <h6 class="mb-0 ">My Purchase</h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="{{ route('member.auth.settings', app()->getLocale()) }}"
                                                        class="iq-sub-card setting-dropdown">
                                                        <div class="media align-items-center">
                                                            <div class="right-icon">
                                                                <i class="ri-settings-4-line text-primary"></i>
                                                            </div>
                                                            <div class="media-body ml-3">
                                                                <h6 class="mb-0 ">Settings</h6>
                                                            </div>
                                                        </div>
                                                    </a>

                                                    <a href="{{ route('member.auth.logout', app()->getLocale()) }}"
                                                        class="iq-sub-card setting-dropdown">
                                                        <div class="media align-items-center">
                                                            <div class="right-icon">
                                                                <i class="ri-logout-circle-line text-primary"></i>
                                                            </div>
                                                            <div class="media-body ml-3">
                                                                <h6 class="mb-0 ">Logout</h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    <li class="nav-item nav-icon">
                                        <a href="{{ route('member.auth.showlogin', app()->getLocale()) }}">
                                            {{ __('login') }}
                                        </a>
                                    </li>
                                    <li class="nav-item nav-icon">
                                        <a href="{{ route('member.auth.register', app()->getLocale()) }}">
                                            {{ __('register') }}
                                        </a>
                                    </li>

                                @endif

                                <li class="menu-item">
                                    <a class="dropdown-toggle dropdown-btn" href="javascript:void(0)"><i
                                            class="fa fa-video-camera" aria-hidden="true"></i>
                                        {{ __('language') }}</a>
                                    <div class="dropdown-menu dropdown-container">
                                        <span class="dropdown-span">
                                            <a class="dropdown-item"
                                                href="{{ route(Route::currentRouteName(), langParamiter(request(), 'en')) }}">English</a>
                                        </span>

                                        <span class="dropdown-span">
                                            <a class="dropdown-item"
                                                href="{{ route(Route::currentRouteName(), langParamiter(request(), 'bn')) }}">Bangla</a>
                                        </span>
                                        <!-- <span class="dropdown-span">
                                            <a class="dropdown-item"
                                                href="{{ route(Route::currentRouteName(), langParamiter(request(), 'hn')) }}">Hindi</a>
                                        </span> -->
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="nav-overlay"></div>
                </div>
            </div>
        </div>
    </div>
</header>


{{-- <x:notify-messages />
<style>
    .items-end {
        z-index: 999999999 !important;
    }

</style> --}}
@push('scripts')
    <script>
        $(document).on('keyup', '#goSearch', function() {

            let search_key = $(this).val();
            $.ajax({
                url: "{{ route('frontend.ajax.search') }}",
                data: {
                    q: search_key
                },
                success: function(data) {
                    // console.log(data.data);
                    $(".SearchView").html(data.data);
                }
            });
            // $(this).closest('.drop_img').remove();
        });

        // mobile responsive dropdown
        // var dropdown = document.getElementsByClassName("dropdown-btn");
        // var i;

        // for (i = 0; i < dropdown.length; i++) {
        //     dropdown[i].addEventListener("click", function() {
        //         console.log( dropdown[i]+);
        //         this.classList.toggle("active");
        //         var dropdownContent = this.nextElementSibling;
        //         console.log(dropdownContent ) ;
        //         if (dropdownContent.style.display === "block") {
        //             dropdownContent.style.display = "none";

        //         } else {
        //             dropdownContent.style.display = "block";

        //         }
        //     });
        // }
    </script>
    {{-- <script>
        var app = new Vue({
            el: '#app',
            data: {
                isSerache: false,
                searchData: null
            },
            methods: {
                isActiveSearch: function() {

                    if (this.isSerache == true) {
                        this.isSerache = false;
                    } else {
                        this.isSerache = true;
                    }
                      alert(this.isSerache);
                },
                someHandler: function() {
                    axios
                      .get('https://api.coindesk.com/v1/bpi/currentprice.json')
                      .then(response => (this.searchData));
                    alert(this.searchData);

                       then(response => (this.searchData));
                }

            }
        })
    </script> --}}

@endpush
