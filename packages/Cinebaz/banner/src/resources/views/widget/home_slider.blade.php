<section id="home" class="iq-main-slider p-0">
    <div id="home-slider" class="slider m-0 p-0">
        {{-- @dd($data->details) --}}

        @isset($data->details)


            @forelse ($data->details as $key => $list)

                {{-- @dd($list) --}}
                {{-- 'is_active' => 'Yes' --}}
                @if ($list->is_active == 'Yes')
                    <div class="slide slick-bg s-bg-1"
                        style="background-image: url('{{ getSliderImage($list, 'full') }}'); height: 100vh;">
                        <div class="container-fluid position-relative h-100">
                            <div class="slider-inner h-100">
                                <div class="row align-items-center h-100">
                                    <div class="col-xl-6 col-lg-12 col-md-12">
                                        <div class="banner-width-custom">

                                            <h1 class="slider-text big-title title text-uppercase"
                                                data-animation-in="fadeInLeft" data-delay-in="0.6" style="font-size: 40px;">
                                                {{ getSliderTitle($list) }}</h1>

                                            {{-- @if (getSliderDescription($list))
                                                <p data-animation-in="fadeInUp" data-delay-in="1.2" class="py-4">
                                                    {!! getSliderDescription($list) !!}

                                                </p>
                                            @endif --}}
                                            <div class="d-flex align-items-center r-mb-23" data-animation-in="fadeInUp"
                                                data-delay-in="1.2">
                                                @if (getSliderDetails($list))
                                                    <a href="{{ route('frontend.details', [app()->getLocale(), getSliderDetails($list)]) }}" class="btn btn-hover">
                                                        More details
                                                    </a>
                                                @endif
                                                {{-- @if (getSliderButton($list))
                                                    <a href="{{ getSliderButton($list) }}" class="btn btn-link" target="_blank">
                                                        <i class="fa fa-play mr-2" aria-hidden="true"></i>
                                                        Watch Trailer
                                                    </a>
                                                @endif --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="trailor-video">
                                    @if (getSliderButton($list))
                                        <a href="{{ getSliderButton($list) }}" class="video-open playbtn">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="80px"
                                                height="80px" viewBox="0 0 213.7 213.7"
                                                enable-background="new 0 0 213.7 213.7" xml:space="preserve">
                                                <polygon class='triangle' fill="none" stroke-width="7"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                                    points="73.5,62.5 148.5,105.8 73.5,149.1 " />
                                                <circle class='circle' fill="none" stroke-width="7" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-miterlimit="10" cx="106.8" cy="106.8"
                                                    r="103.3" />
                                            </svg>
                                            <span class="w-trailor">
                                                Watch Trailer
                                            </span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
            @endforelse
        @endisset
    </div>
    {{-- <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" width="44px" height="44px" id="circle"
            fill="none" stroke="currentColor">
            <circle r="20" cy="22" cx="22" id="test"></circle>
        </symbol>
    </svg> --}}
</section>


