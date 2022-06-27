@extends('layouts.master')

@section('content')

    @isset($slider)
        <!-- Slider Start -->
        @include('banner::widget.home_slider',['data' => $slider])
        <!-- Slider End -->
    @endisset
{{-- @dd($section) --}}

    <!-- MainContent -->

    <div class="main-content full-ind-hid" id="web-view">
        <!--Categories Slider Start -->
        @include('layouts.part.categories',['slider' => $categories])
        <!-- Categories Slider End -->
        @foreach ($section as $slider)
            @include('layouts.part.slider_section',['slider'])
        @endforeach
    </div>

    {{-- Mobile Responsive Sart --}}
    {{-- <div class="main-content mobile-ind-hid" id="mobile-view">
        <!--Categories Slider Start -->
        @include('layouts.part.categories',['slider' => $categories])
        <!-- Categories Slider End -->
        @foreach ($section as $slider)
            @include('layouts.part.mobile_slider_section',['slider'])
        @endforeach
    </div> --}}
    {{-- Mobile Responsive End --}}

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
<script>
 </script>
@endpush



