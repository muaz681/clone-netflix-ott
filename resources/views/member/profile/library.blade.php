@extends('layouts.master')
@section('content')
    {{--  --}}

    <section class="m-profile setting-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 mb-3">
                    <div class="library-full_card">
                        <div class="sign-user_card text-center">
                            <div class="image-change">
                                @if(count($user->images)>0)
                                    <img src="{{url('storage/'.$user->images[0]->thumbnail)}}" class="img-fluid d-block mx-auto mb-3" alt="{{$user->name}}" id="image">
                                @else
                                    <img src="{{ Gravatar::src('https://www.gravatar.com/avatar/', 150) }}" class="img-fluid d-block mx-auto mb-3" alt="{{$user->name}}" id="image">
                                    {{--  <img src="https://visualpharm.com/assets/30/User-595b40b85ba036ed117da56f.svg" class="img-fluid d-block mx-auto mb-3" alt="{{$user->name}}" id="image">  --}}
                                @endif

                                    {{-- <input name="image"class="form_gallery-upload" type="file" accept=".png, .jpg, .jpeg" value="{{ old('image') }}" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])" > --}}
                            </div>
                            <h4 class="mb-3">{{ $user->name }}</h4>
                            @include('member.profile.common.member-profile-menu')
                        </div>

                    </div>

                </div>

                <div class="col-lg-9 overflow-hidden">
                    {{-- style="padding-top: 70px" --}}

                    <section id="iq-upcoming-movie">
                        @isset($lastWatch)
                            @include('layouts.part.slider_favorites',['slider' => $lastWatch])
                        @endisset
                    </section>


                    <section id="iq-upcoming-movie">
                        @isset($listing)
                            @include('layouts.part.slider_favorites',['slider' => $listing])
                        @endisset
                    </section>
                    <section id="iq-list-movie">
                        @isset($favorites)
                            @include('layouts.part.slider_favorites',['slider' => $favorites])
                        @endisset
                    </section>
                </div>
            </div>
        </div>
    </section>


@endsection
@push('style')
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
