@isset($slider['data'])
    @if (count($slider['data']) > 0)

        {{-- <section id="iq-favorites">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-revert">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title"><a
                                    href="javascript:void(0);">{{ isset($slider['name']) ? $slider['name'] : null }}</a>
                            </h4>
                        </div>
                        <div class="favorites-contens">
                            <ul class="favorites-slider list-inline  row p-0 mb-0">

                                @foreach ($slider['data'] as $key => $value)
                                    @if ($value->media)
                                        @include('layouts.part.slider_cart',['sdata' => $value->media])
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        <div class="container-fluid">
            <div class="row slide-padd">
                <div class="col-md-12">
                    <h1 class="text-xl font-medium font-netflix_medium text-white">
                        <a href="javascript:void(0);">{{ isset($slider['name']) ? __($slider['name']) : null }}</a>
                    </h1>
                    @isset($slider['data'])
                        <video-carousel :mdata="{{ $slider['data']->toJson() }}"
                            :member="{{ auth('member')->user() ? auth('member')->user() : '{}' }}"
                            paycurrency="{{ PayCurrency() }}"
                            local="{{ app()->getLocale() }}"
                        ></video-carousel>
                    @endisset
                </div>
            </div>
        </div>
    @endif
@endisset
