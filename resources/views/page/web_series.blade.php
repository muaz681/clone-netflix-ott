
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
            <section class="episode-section container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="trending-info g-border">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="d-flex relative">
                                        <h1 class="trending-text big-title text-uppercase mt-0">{{ strtoupper($mdata->title_en) }}
                                        </h1>
                                    </div>
                                    <div class="series-drp">
                                        {{-- <div class="dropdown">
                                            <button id="dLabel" class="dropdown-select dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              Select
                                              <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                              <li> <a href="#">Option 1</a></li>
                                              <li> <a href="#">Option 2</a></li>
                                              <li> <a href="#">Option 3</a></li>
                                              <li> <a href="#">Option 4</a></li>
                                              <li> <a href="#">Option 5</a></li>

                                            </ul>
                                          </div> --}}

                                        <span class="trending-year mdls"><strong></strong> {{date('j F',strtotime($mdata->published_at))}} </span>
                                        <span class="badge badge-secondary badge-age-limit mdls"><strong></strong> {{ $mdata->release_year }} </span>
                                        <span class="badge badge-secondary badge-age-limit mdls">HD</span>

                                    </div>
                                    <span><strong>Genre :</strong>&nbsp;
                                        @foreach ($mdata->genres as $key => $list)
                                            {{ $key != 0 ? ',' : '' }} <a
                                                href="{{ route('frontend.gener.media_list', [app()->getLocale() ,$list->slug]) }}">{{ $list->title_en }}</a>
                                        @endforeach
                                    </span>
                                    <br/>
                                    @php

                                        $occupation = [];
                                        foreach ($mdata->occupations as $key => $item) {
                                            $occupations[$item->pivot->occupation_id] = $item;
                                        }

                                        $artists = [];
                                        foreach ($mdata->artists as $key => $item) {
                                            $artists[$item->pivot->artist_id] = $item;
                                        }


                                    @endphp
                                    <ul class="pt-2">
                                        @foreach($occupation as $key => $list)

                                            @php
                                                $relations_artist = \App\Models\MediaArtistOcccupation::where('media_id' , $media->id)->where('occupation_id' , $list->id)->select('artist_id')->distinct()->get();
                                            @endphp
                                            <li><span><strong>{{$list->title}} : </strong></span>
                                                @foreach($relations_artist as $keyss => $val)
                                                    {{ $keyss !=0 ? ',' : '' }}
                                                    @php
                                                        $artist =  \App\Models\Artist::where('id' , $val->artist_id)->first();
                                                    @endphp
                                                    <a href="{{ route('frontend.artist.profile', [app()->getLocale() ,$artist->slug]) }}">{{$artist->name}}</a>
                                                @endforeach
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <div class="details-right-sec">
                                        @if ($mdata->premium == 1 && $mdata->published_at && $mdata->published_at < date('Y-m-d H:i:s'))
                                        @if ($mdata->premium == 1)
                                        @php
                                            $movie_in_cart = [];
                                            foreach (MyCart() as $cart) {
                                                array_push($movie_in_cart, $cart->name);
                                            }
                                        @endphp
                                        @if(CountMyCart() > 0 && in_array($mdata->title_en, $movie_in_cart))
                                            <span class="badge badge-secondary badge-tag">
                                                <span class="changeCss">
                                                    <div class="pretext">
                                                        <i class="fas fa-cart-plus"></i> CART ADDED
                                                    </div>
                                                </span>
                                            </span>
                                        @else
                                            <span class="badge badge-secondary badge-tag">
                                                <a href="javascript:void(0)" onclick="AddToCart({{ $mdata->id }})">
                                                    <span class="addtocart">
                                                        <div class="pretext">
                                                            <i class="fas fa-cart-plus"></i> ADD TO CART
                                                        </div>
                                                    </span>
                                                </a>
                                            </span>
                                        @endif
                                        

                                        <span class="d-block details-price-page"><strong>Price :</strong>&nbsp;
                                            <span class="position-relative">
                                                <span class="planbox__header__strike-through">{{  $mdata->regular_price ? PayCurrency($mdata->regular_price) : null  }}</span>
                                            </span>
                                                <span class="badge badge-secondary badge-age-limit">{{ $mdata->discount_price ? PayCurrency($mdata->discount_price) : null }}</span>

                                        </span>
                                        @endif
                                        @elseif($mdata->premium == 0 && $mdata->published_at && $mdata->published_at < date('Y-m-d H:i:s'))
                                            <span class="badge badge-secondary badge-tag det-fre">
                                                <span class="addtocart">
                                                    <div class="pretext">
                                                         {{ FreeTag() }}
                                                    </div>
                                                </span>
                                            </span>
                                        @elseif($mdata->published_at == null || $mdata->published_at > date('Y-m-d H:i:s'))
                                            <span class="badge badge-secondary badge-tag det-up">
                                                <span class="addtocart">
                                                    <div class="pretext">
                                                         {{ UpcomingTag() }}
                                                    </div>
                                                </span>
                                            </span>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Episodes</a>
                            </li>
                            <li class="nav-item" role="presentation">
                              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Details</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                @foreach($mdata->episodes as $key => $media)
                                {{-- Start Episodes --}}
                                <a href="#" class="card mb-3 episode">
                                    <div class="row no-gutters">
                                      <div class="col-md-3">
                                        <img src="{{asset('storage/'. (isset($media->featuredL->small)? $media->featuredL->small: 'noimage.jpeg') )}}" class="img-fluid" alt="{{$media->title}}">
                                      </div>
                                      <div class="col-md-9">
                                        <div class="card-body">
                                          <h5 class="card-title"> {{$key+1}}. {{$media->title_en}}</h5>
                                          <p class="epsd-nmb">
                                            <span class="badge-age-limit mdls"><strong></strong> {{date('j F, Y',strtotime($media->published_at))}}</span>
                                            <span class="badge badge-secondary badge-age-limit mdls"><strong></strong> {{$media->duration}}</span>
                                            <span class="badge badge-secondary badge-age-limit mdls">{{$media->video_type}}</span>
                                          </p>
                                          <div class="card-text">  {!! $media->description_en !!}</div>
                                        </div>
                                      </div>
                                    </div>
                                </a>
                                @endforeach

                                {{-- End Episodes --}}
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h2>More Details</h2>
                                <div class="text-justify py-5">
                                    @if ($mdata->description_en)
                                        <p class="">
                                            {!! $mdata->description_en !!}
                                        </p>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
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
