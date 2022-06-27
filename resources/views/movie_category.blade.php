@extends('layouts.master')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.js"></script>
    <!-- Slider Start -->
    <section id="home" class="iq-main-slider p-0">
        <div id="home-slider" class="slider m-0 p-0">
           {{-- @dd($cat_slider) --}}
            @foreach ($cat_slider as $slider)
                <div class="slide slick-bg s-bg-1"
                    style="background-image:url('{{ asset($slider->featuredL ? 'storage/' . $slider->featuredL->full : 'https://cdn.designcrowd.com/blog/2018/March/50-Typographic-Oscars-Film-Posters/GR_Typographic-Oscar-Film-Posters_Banner_828x300.jpg') }}') !important">
                    <div class="container-fluid position-relative h-100">
                        <div class="slider-inner h-100">
                            <div class="row align-items-center  h-100">
                                <div class="col-xl-6 col-lg-12 col-md-12">
                                    <h1 class="slider-text big-title title text-uppercase" data-animation-in="fadeInLeft"
                                        data-delay-in="0.6" style="font-size: 40px;">{{ $slider->title_en }}</h1>
                                    
                                    <div class="d-flex align-items-center r-mb-23" data-animation-in="fadeInUp"
                                        data-delay-in="1.2">
                                        <a href="{{ route('frontend.details', [app()->getLocale(),$slider->slug]) }}" class="btn btn-link">
                                            {{ $slider->details_button_text ? $slider->details_button_text : 'More details' }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Slider End -->
    <!-- MainContent -->
    <div class="main-content catogory-content">
        @forelse ($categories as $key =>  $list)
            @include('layouts.part.slider_category',['slider' => ['data' => $list->medias, 'name' =>
            $list->title_english,'cat_slug' => $list->slug]])
        @empty
            @include('layouts.essential.empty')
        @endforelse
    </div>

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
