@isset($slider['data'])
@if(count($slider['data']) > 0)
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
