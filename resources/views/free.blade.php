@extends('layouts.master')

@section('content')

    <!-- MainContent -->

    <div class="main-content">
        <!-- Free Movie Slider Start -->
        @include('layouts.part.slider_section',['slider' => $free])
        <!-- Free Movie Slider End -->
    </div>

@endsection
