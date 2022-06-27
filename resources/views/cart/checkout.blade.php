@extends('layouts.master')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://unpkg.com/vue@next"></script>
    <div class="main-content">
        <div class="cart_section">
            <div class="container-fluid">
                <div class="row">
 
                    <div class="col-lg-10 offset-lg-1">
                        <form method="POST" action="{{ route('frontend.cart.checkout.process', [app()->getLocale()]) }}"
                            enctype="multipart/form-data">
                            @csrf()
                            @if (CountMyCart() != 0)
                                <div class="cart_container">
                                    <div class="cart_title py-3">Movie Cart<small> ({{ CountMyCart() }} Movie in your cart)
                                        </small></div>
                                    {{--  --}}
                                    <div class="row">
                                        {{-- Checkout movie list site --}}
                                        <div class="col-md-12 col-sm-12">
                                            <div class="cart_items">
                                                <table class="table bg-color table-responsive checkout-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Image</th>
                                                            <th>Name</th>
                                                            <th>Qty</th>
                                                            <th>Total Hour</th>
                                                            <th>Watch Hour</th>
                                                            <th>Price</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse (MyCart() as $cart)
                                                            <tr>
                                                                <td>
                                                                    <img src="{{ asset($cart->associatedModel->featured ? 'storage/' . $cart->associatedModel->featured->small : 'assets/frontend/images/noimage-p.png') }}"
                                                                        alt="" style="height:70px;">
                                                                </td>
                                                                <td>{{ $cart->name }}</td>
                                                                <td>{{ $cart->quantity }}</td>
                                                                <td>{{ $cart->associatedModel->duration }}</td>
                                                                <td>{{ $cart->attributes->hour }}</td>
                                                                <td>{{ PayCurrency() }} {{ $cart->price }}</td>
                                                                <td>
                                                                    <a href="{{ route('frontend.cart:remove', $cart->id) }}"
                                                                        class="btn btn-hover">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                            height="16" fill="currentColor"
                                                                            class="bi bi-backspace" viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z" />
                                                                            <path
                                                                                d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z" />
                                                                        </svg>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="50" class="text-center text-danger">
                                                                    Your Card Is Empty!
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="order_total">
                                                <div class="order_total_content text-md-right">
                                                    <div class="order_total_title"> Order Total: </div>
                                                    <div class="order_total_amount"> {{ PayCurrency() }}
                                                        {{ MyCartTotal() }}</div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-12 col-sm-12">
                                            <h2 class="py-4">Payment Method</h2>
                                            <div class="row">
                                                <div class="col-md-12 payment_method">
                                                    @foreach (config('order.payment-medthod') as $key => $list)
                                                        @if ($list['status'] == 'Active')
                                                            <label type="button" data-toggle="tooltip" data-placement="top" title="{{ $list['name'] }}">
                                                                <input type="radio" name="payment_type"
                                                                    value="{{ $key }}">
                                                                <span>
                                                                    <img src="{{ url($list['logo']) }}"
                                                                        class="img-fluid" alt="">
                                                                </span>
                                                            </label>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            @error('payment_type')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            {{-- Payment Option site End --}}
                                        </div>

                                        <div class="col-md-12 col-sm-12">
                                            <div class="tacbox">
                                                <input id="checkbox" type="checkbox" name="i_agree" />
                                                <label for="checkbox"> I agree to these <a target="_blank"
                                                        href="{{ route('frontend.tearms-conditions', [app()->getLocale()]) }}">Terms
                                                        and Conditions</a>, <a target="_blank"
                                                        href="{{ route('frontend.privacy', [app()->getLocale()]) }}">Privacy
                                                        Policy</a>, <a target="_blank"
                                                        href="{{ route('frontend.return-conditions', [app()->getLocale()]) }}">Return
                                                        & Refund</a></label>



                                                @error('i_agree')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-sm-12">

                                            {{--  --}}
                                            <div class="cart_buttons">
                                                <a href="{{ route('frontend.movie', [app()->getLocale()]) }}"
                                                    class="btn btn-default" style="background-color:white;color:black;"> Buy
                                                    More
                                                </a>
                                                <button type="submit" class="btn btn-hover"> Buy Tickets </button>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @include('layouts.essential.cart_empty')
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')

    <style>
        .bg-color {
            background-color: #424242;
            color: #fff !important;
        }

        td img {
            height: 80px;
        }

        td {
            vertical-align: middle !important;
        }

        .cart_items {
            overflow-x: scroll;
        }

        .cart_items::-webkit-scrollbar {
            display: none;
        }

        .cart_items {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .fixed {
            /* z-index: 9999999999 !important; */
        }

        .table td,
        .table th {
            border-top: 1px solid transparent !important;
        }

        .table thead th {
            border-bottom: 1px solid #686868 !important;
        }

        .tacbox {
            display: block;
        }

        .tacbox label {
            margin-left: 15px;
        }

        .tacbox a {
            color: #f7941d;
        }

    </style>

@endpush
