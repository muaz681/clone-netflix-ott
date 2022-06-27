@extends('layouts.master')

@section('content')
    <!-- Slider Start -->
    <div class="main-content all-mv-content">
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
