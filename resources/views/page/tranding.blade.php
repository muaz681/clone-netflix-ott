@extends('layouts.master')

@section('content')

<!-- Slider Start -->
@isset($slider)
@include('banner::widget.home_slider',['data' => $slider])
@endisset
<!-- Slider End -->

<div class="main-content" style="padding-top:70px;padding-bottom:70px;">
    @include('layouts.part.page_section',['mdata' => $trandings])

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

        .listWithoutSlider .slide-item {
            padding: 12px 8px !important;
            list-style: none;
        }


        @media (max-width:767px) {
            .listWithoutSlider {
                justify-content: center;
            }
        }

    </style>

@endpush
