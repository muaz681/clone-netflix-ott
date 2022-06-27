@isset($mdata['data'])
@if(count($mdata['data']) > 0)
{{-- @dd($mdata['data']) --}}


{{-- <section id="iq-favorites" style="padding-top: 17px; min-height: 70vh;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 overflow-hidden">
                <div class="iq-main-header align-items-center justify-content-between">
                    <h4 class="main-title text-center" style="font-size: 30px">
                       {{ $mdata['name'] }}
                    </h4>
                </div>
                <div class="favorites-contens">
                    <ul class="row p-0 mb-0  listWithoutSlider">
                        @forelse($mdata['data'] as $sdata)
                            @isset($sdata)
                                @include('layouts.part.slider_cart',['sdata' => $sdata])
                            @endisset
                        @empty
                            @include('layouts.essential.empty')
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<div class="container-fluid">
    <div class="row slide-padd">
      <div class="col-md-12">
        <div class="iq-main-header align-items-center justify-content-between">
            <h4 class="main-title text-center" style="font-size: 30px">
               {{ $mdata['name'] }}
            </h4>
        </div>
        @isset($mdata['data'])
            <video-carousel :mdata="{{ $mdata['data']->toJson() }}"
                :member="{{ auth('member')->user() ? auth('member')->user() : '{}' }}"
                paycurrency="{{ PayCurrency() }}"
                local="{{ app()->getLocale() }}"
            ></video-carousel>
        @endisset
    </div>
    </div>
  </div>

@else
@include('layouts.essential.empty')
@endif
@endisset
