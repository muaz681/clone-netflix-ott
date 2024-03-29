@extends('layouts.master')
@section('content')
    <style>
        .block-description>h6 {
            font-size: 1em;
        }

    </style>
    <!-- MainContent -->
    <section id="iq-upcoming-movie" class="m-profile" style="padding-top: 100px;">
        @isset($bucketList)
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 mb-3">
                        <div class="sign-user_card text-center">
                            <div class="image-change">
                                @if (count($user->images) > 0)
                                    <img src="{{ url('storage/' . $user->images[0]->thumbnail) }}"
                                        class="img-fluid d-block mx-auto mb-3" alt="{{ $user->name }}" id="image">
                                @else
                                    <img src="{{ Gravatar::src('https://www.gravatar.com/avatar/', 150) }}"
                                        class="img-fluid d-block mx-auto mb-3" alt="{{ $user->name }}" id="image">
                                    {{-- <img src="https://visualpharm.com/assets/30/User-595b40b85ba036ed117da56f.svg" class="img-fluid d-block mx-auto mb-3" alt="{{$user->name}}" id="image"> --}}
                                @endif
                                {{-- <input name="image" class="form_gallery-upload" type="file" accept=".png, .jpg, .jpeg"
                                    value="{{ old('image') }}"
                                    onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])"> --}}
                            </div>
                            <h4 class="mb-3">{{ $user->name }}</h4>
                            @include('member.profile.common.member-profile-menu')
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="sign-user_card">
                            <div class="row justify-content-between mb-3">
                                <div class="col-md-12 r-mb-15">
                                    <div style="overflow-x:auto;">
                                        <table class="table text-light">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th> Image </th>
                                                    <th> Description </th>
                                                    <th> Deadline </th>
                                                    <th class="text-center"> Status </th>
                                                    <th class="text-center"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @if ($bucketList)

                                                    @forelse($bucketList as $bucket)
                                                        {{-- @dd($bucketList) --}}
                                                        <tr>
                                                            <td>{{ $loop->index + 1 }}</td>
                                                            <td><img src="{{ asset($bucket->medias && $bucket->medias->featured ? 'storage/' . $bucket->medias->featured->small : null) }}"
                                                                    style="height:70px;"></td>
                                                            <td>
                                                                <h5>{{ $bucket->medias->title_en }}</h5>
                                                                <p>
                                                                    <span> Invoice :
                                                                        {{ $bucket->orders ? $bucket->orders->code : null }}
                                                                        /
                                                                    </span>
                                                                    <span> Price : {{ PayCurrency() }}
                                                                        {{ $bucket->medias ? $bucket->medias->discount_price : null }}
                                                                    </span>
                                                                </p>
                                                            </td>
                                                            <td>{{ date('dM, Y', strtotime($bucket->deadline)) }}</td>
                                                            <td>
                                                                <p
                                                                    class="{{ $bucket->orders->status == 'Completed' ? 'green' : 'red' }}">
                                                                    {{ $bucket->orders->status }}</p>
                                                            </td>
                                                            <td>

                                                                @php
                                                                    $deadline = new DateTime($bucket->deadline);
                                                                    $today = new DateTime('now');
                                                                @endphp

                                                                <div class="btn-group" role="group"
                                                                    aria-label="Basic example">
                                                                    @if ($deadline > $today)
                                                                        <a href="{{ route('frontend.details', [app()->getLocale(), $bucket->medias->slug]) }}"
                                                                            class="btn btn-warning"><i
                                                                                class="fa fa-eye"></i></a>
                                                                    @else
                                                                        <a href="javascript:void(0)"
                                                                            onclick="AddToCart({{ $bucket->medias->id }})"
                                                                            class="btn btn-danger"><i
                                                                                class="fa fa-shopping-cart"></i></a>
                                                                    @endif
                                                                    {{-- <a href="{{ url('/ticket/invoice?code=' . $bucket->orders->code) }}"
                                                                        class="btn btn-warning"><i
                                                                            class="fa fa-info"></i></a> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="10" class="text-center text-danger"> Nothing to show
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                @else
                                                    <tr>
                                                        <th colspan="6" class="text-center"> Nothing to show </th>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        {{ $bucketList->links('pagination::bootstrap-4') }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </section>
    <!-- MainContent End-->
@endsection
@push('styles')
    <style>
        .bucket_card {
            background-color: #424242;
            margin-bottom: 30px;
        }

        .green {
            background-color: green;
            text-align: center;
            padding: 10px;
        }

        .red {
            background-color: tomato;
            text-align: center;
            padding: 10px;
        }

        .page-link {
            background-color: transparent !important;
            color: white;
        }

        .active {
            background-color: #f4921d;
        }

    </style>
@endpush
