
@extends('layouts.master')
@section('content')
        <section class="pay-complete">
            <div class="container">
                <div class="row">
                   <div class="col-md-6 mx-auto mt-5">
                      <div class="payment">
                         <div class="payment_header">
                            <div class="check"><i class="fa fa-check" aria-hidden="true"></i></div>
                         </div>
                         <div class="content">
                            <h1>Payment Success !</h1>
                            <p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. </p>
                            <a href="#">Go to Home</a>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
        </section>
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

    


@endpush
