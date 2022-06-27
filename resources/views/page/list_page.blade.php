@extends('layouts.master')

@section('content')
    <!-- MainContent -->
    <div class="main-content" style="padding-top:70px;padding-bottom:70px;">
        @include('layouts.part.category_details',['medias' => ['cat_med' => $catMedias, 'cat_name' => $cat]])
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
