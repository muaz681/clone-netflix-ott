@isset($sdata)
    <li class="slide-item">
        <div class="block-images position-relative">
            <div class="img-box slider-img-box">
                @if (auth('member')->check())
                    <div class="block-social-info">
                        @if($sdata->published_status == 0)
                        <ul class="list-inline p-0 m-0 music-play-lists">
                            <li>
                                <span onclick="addFavorite(this)" data-route="{{route('frontend.ajax.favorite',[app()->getLocale() , $sdata->id])}}" data-id="{{ $sdata->id }}"
                                    class="{{ in_array($sdata->id, $member['favorites']) ? 'active' : 'fevourit' }} fev{{ $sdata->id }} ">
                                    <i class="ri-heart-fill"></i></span>
                            </li>
                            <li>
                                <span onclick="addListing(this)" data-route="{{route('frontend.ajax.listing',[app()->getLocale() , $sdata->id])}}" data-id="{{ $sdata->id }}"
                                    class="{{ in_array($sdata->id, $member['listing']) ? 'active' : 'listing' }} list{{ $sdata->id }}">
                                    <i class="ri-add-line"></i></span>
                            </li>
                        </ul>
                        @endif
                    </div>
                @endif
                @if ($sdata->premium == 1 && $sdata->published_at && $sdata->published_at < date('Y-m-d H:i:s'))
                    <span class="premium-tag">
                        <span class="planbox__header__strike-through">{{  $sdata->regular_price ? PayCurrency($sdata->regular_price) : null  }}</span>
                        <span>{{ $sdata->discount_price ? PayCurrency($sdata->discount_price) : null }}</span>
                    </span>
                @elseif($sdata->premium == 0 && $sdata->published_at && $sdata->published_at < date('Y-m-d H:i:s'))
                        <span class="free-tag">
                        <span>{{ __(FreeTag()) }}</span>
                        </span>
                    @elseif($sdata->published_at == null || $sdata->published_at > date('Y-m-d H:i:s')) <span
                            class="upcoming-tag">
                            <span>{{ __(UpcomingTag()) }}</span>
                        </span>
                    @elseif($sdata->published_status == 0 )
                        <div class="cardupcoming"></div>
                @endif
                <a href="{{ route('frontend.details', [app()->getLocale(), $sdata->slug]) }}">
                    @if ($sdata->featured)
                        <img data-original="{{ asset('storage/' . $sdata->featured->small) }}"
                            src="{{ asset('storage/' . $sdata->featured->small) }}" class="img-fluid" alt="">
                    @else
                        <img data-original="{{ asset('assets/frontend/images/noimage-p.png') }}"
                            src="{{ asset('assets/frontend/images/noimage-p.png') }}" class="img-fluid" alt="">
                    @endif
                </a>
            </div>

            <div class="block-description">

                <div class="movie-time d-flex align-items-center my-2 remove-age-limit">
                    <div class="badge badge-secondary p-1 mr-2">{{ $sdata->age_limit ? $sdata->age_limit : null }}</div>
                    <span class="text-white">{{ $sdata->duration ? $sdata->duration : null }}</span>
                </div>
                    <div class="hover-buttons">
                        {{-- @if ($sdata->published_status == 1)
                            <a href="{{ route('frontend.details', [app()->getLocale(), $sdata->slug]) }}">
                                <span class="btn btn-warning">
                                    <i class="fa fa-play" aria-hidden="true"></i>
                                </span>
                            </a>
                        @endif --}}
                        @if ($sdata->published_status == 0 && $sdata->premium == 0)
                            <a href="{{ route('frontend.details', [app()->getLocale(), $sdata->slug]) }}">
                                <span class="btn btn-warning">
                                    <i class="fa fa-play" aria-hidden="true"></i>
                                </span>
                            </a>
                        @endif
                        @if ($sdata->premium == 1)
                            <a href="javascript:void(0)" onclick="AddToCart({{ $sdata->id }})">
                                <span class="btn btn-warning">
                                    <i class="fa fa-shopping-cart mr-1" aria-hidden="true"></i>
                                </span>
                            </a>
                        @endif
                    </div>



                <h6 class="hover-heading">
                    <a href="{{ route('frontend.details', [app()->getLocale(), $sdata->slug]) }}">
                        {{ $sdata->title_en }}
                    </a>
                </h6>
            </div>

        </div>
    </li>
@endisset


