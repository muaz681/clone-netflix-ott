
@extends('layouts.master')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.js"></script> -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @php

    if (isset($mdata->featuredL->full)) {
        $bg = asset('storage/' . $mdata->featuredL->full);
    } else {
        $bg = asset('assets/frontend/images/noimage-l.jpg');
    }
    //  @dump($bg)
    
    @endphp
    @isset($mdata)
    {{-- @dd($mdata) --}}
        <section class="banner-wrapper overlay-wrapper iq-main-slider" style="background-image: url('{{ $bg }}');">
            {{-- trailler button --}}
            @if ($mdata->trailer_url)
                <div class="trailor-video">
                    <a href="{{ $mdata->trailer_url }}" class="video-open playbtn" tabindex="0">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                            y="0px" width="80px" height="80px" viewBox="0 0 213.7 213.7" enable-background="new 0 0 213.7 213.7"
                            xml:space="preserve">
                            <polygon class="triangle" fill="none" stroke-width="7" stroke-linecap="round"
                                stroke-linejoin="round" stroke-miterlimit="10" points="73.5,62.5 148.5,105.8 73.5,149.1 ">
                            </polygon>
                            <circle class="circle" fill="none" stroke-width="7" stroke-linecap="round"
                                stroke-linejoin="round" stroke-miterlimit="10" cx="106.8" cy="106.8" r="103.3"></circle>
                        </svg>
                        <span class="w-trailor">
                            Watch Trailer
                    </a>
                </div>
            @endif
                <div class="exeptionlogin-caption" style="width: 100%">
                    <div class="position-relative mb-12">
                        <div class="exeptionlogin">
                            <div class="app-store-caption">
                                <div class="full-head">
                                    <h1 class="pb-3 app-heading">To watch this Movie<br />
                                        <span>Please Download</span> our App</h1><br />
                                        <div class="app-download text-center d-flex justify-content-center">

                                            <div class="qr-code mr-3">
                                                <!-- <img src="https://fv9-3.failiem.lv/thumb_show.php?i=9kdutssem&view" class="img-fluid mb-1" /> -->
                                                @if (isset($setting['playstore-url']) && isset($setting['playstore']))
                                                    <a href="{{ route('download_android',[app()->getLocale()]) }}" target="_blank">
                                                        <img src="{{ asset($setting['playstore']) }}" class="img-fluid" />
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="qr-code ml-3">
                                                <!-- <img src="https://fv9-2.failiem.lv/thumb_show.php?i=hbk35y9dw&view" class="img-fluid mb-1" /> -->
                                                @if (isset($setting['appstore-url']) && isset($setting['appstore']))
                                                    <a href="{{ $setting['appstore-url'] }}" target="_blank">
                                                        <img src="{{ asset($setting['appstore']) }}" class="img-fluid" />
                                                    </a>
                                                @endif
                                            </div>
                                        </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
        </section>
        <!-- Slider End -->
        <div class="main-content details-play-group-button">
            <section class="movie-detail container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                            {{-- top part --}}
                        <div class="trending-info g-border">
                            <div class="row">
                                <div class="col-md-8 py-2">
                                    <div class="d-flex relative">
                                        <h1 class="trending-text big-title text-uppercase mt-0">{{ strtoupper($mdata->title_en) }}
                                        </h1>
                                    </div>
                                    <div class="text-justify">
                                        @if ($mdata->description_en)
                                            <p class="">
                                                {!! $mdata->description_en !!}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 py-2">
                                    <div class="details-right-sec">
                                        <div class="combo-pack">
                                            {{-- @dump($mdata) --}}
                                            <div class="card-header bg-transparent">
                                                {{ $mdata->title_en }}
                                                {{-- <span>This Part is Combo</span> --}}
                                            </div>
                                            <div class="card-footer bg-transparent">{{ count($mdata->combo) }} - Videos</div>
                                            <div class="card-footer bg-transparent">
                                                <span class="d-block details-price-page"><strong>Price :</strong>&nbsp;
                                                    <span class="position-relative">
                                                        {{-- @dump($mdata->regular_price) --}}
                                                        <span class="planbox__header__strike-through">{{  $mdata->regular_price ? PayCurrency($mdata->regular_price) : null  }}</span>
                                                    </span>
                                                        <span class="badge badge-secondary badge-age-limit">{{ $mdata->discount_price ? PayCurrency($mdata->discount_price) : null }}</span>
                                                </span>
                                            </div>
                                            {{-- @dump($mdata) --}}
                                            <div class="card-footer bg-transparent">Validity Date: {{  $mdata->validity  }} Days</div>
                                            
                                            <div class="card-footer">
                                                <a href="javascript:void(0)" onclick="AddToCart({{ $mdata->id }})">
                                                    <span class="addtocart">
                                                        <div class="pretext">
                                                            <i class="fas fa-cart-plus"></i> ADD TO CART
                                                        </div>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 py-3">
                                    <div class="card">
                                        <h5 class="card-header">Combo</h5>
                                        <div class="card-body combo-slide-img">
                                            <ul class="favorites-slider list-inline  row p-0 mb-0">
                                            @foreach ($mdata->combo as $list)
                                                <li class="slide-item">
                                                    <div class="block-images position-relative">
                                                        <div class="img-box slider-img-box">
                                                            <a href="{{ route('frontend.details', [app()->getLocale(), $list->slug]) }}">
                                                                @if ($list->featuredL)
                                                                    <img data-original="{{ asset('storage/' . $list->featuredL->small) }}"
                                                                        src="{{ asset('storage/' . $list->featuredL->small) }}" class="img-fluid" alt="">
                                                                @else
                                                                    <img data-original="{{ asset('assets/frontend/images/noimage-p.png') }}"
                                                                        src="{{ asset('assets/frontend/images/noimage-p.png') }}" class="img-fluid" alt="">
                                                                @endif
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                            </ul>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                            {{-- top part end --}}
                            {{-- bottom part  --}}
                        
                            {{-- bottom part End --}}
                    </div>
                </div>
            </section>
            {{-- <section class="container-fluid combo-det-tab">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
                    </li>
                    
                    
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        @include('layouts.part.slider_section',['slider' => $recomended])
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        @include('layouts.part.slider_simier',['slider' => $similer])
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">  
                        @include('layouts.part.slider_section',['slider' => $upcoming])
                    </div>
                    
                  </div>
            </section> --}}
            @include('layouts.part.slider_simier',['slider' => $similer])
            @include('layouts.part.slider_section',['slider' => $recomended])
            @include('layouts.part.slider_section',['slider' => $upcoming])
            
            
            
        </div>
    @endisset

@endsection
@push('styles')
    <style>
        .makeupinstation {
            display: block;
        }

        .makeupinstation small {
            color: #9E9E9E;
            font-weight: 200;
        }

    </style>
@endpush
@push('scripts')

    <script type="text/javascript">
        function Copy(link_url) {
            var copyText = link_url;

            document.addEventListener('copy', function(e) {
                e.clipboardData.setData('text/plain', copyText);
                e.preventDefault();
            }, true);

            document.execCommand('copy');
            alert('copied text: ' + copyText);
        }
    </script>
    <script>
        var $temp = $("<input>");
        var $url = $(location).attr('href');

        $('.clipboard').on('click', function() {
            $("body").append($temp);
            $temp.val($url).select();
            document.execCommand("copy");
            $temp.remove();
            $("button").text("copied!");
        })
    </script>



@endpush