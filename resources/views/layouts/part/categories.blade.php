@isset($slider['data'])
@if(count($slider['data']) > 0)
{{-- @dd($slider['data']) --}}
<section id="iq-favorites">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 overflow-hidden">
                <div class="iq-main-header d-flex align-items-center">
                    <h4 class="main-title">
                        <a href="javascript:void(0);">{{ isset($slider['name'])? $slider['name'] : null }}</a>
                        
                    </h4>
                    {{-- <a href="twitter://user?muaz681=ler">Twitter</a> --}}
                    <a href="{{ route('frontend.movie', [app()->getLocale()]) }}" style="margin-left: 5px;" class="category-see-more">See More</a>
                </div>
                <div class="favorites-contens">
                    <ul id="ratan" class="customize-favrt-slider list-inline  row p-0 mb-0">

                        {{-- @foreach($slider['data'] as $key => $value)
                            @include('layouts.part.category_cart',['sdata' => $value])
                        @endforeach --}}
                        @include('layouts.part.category_cart')
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endisset

