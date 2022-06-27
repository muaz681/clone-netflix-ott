@extends('layouts.master')
@section('content')
    <section class="single-page">
        <div class="container container-sp">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <h2><strong>Help Center</strong></h2>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Head Office</h3>
                                <p>80/5 VIP Rd, Dhaka 1000, Bangladesh</p>
                                <p>+8801958095007</p>
                                <p>info@cinebaz.com</p>
                                <div>
                                    <h3>Live Chat</h3>
        
                                    <a href="javascript:void(Tawk_API.toggle())" class="live-chat">Start Live Chat </a>
                                </div>
                            </div>
                            <div class="col-md-6">
        
                                <!--Start of Tawk.to Script-->
        
                                <!--End of Tawk.to Script-->
                                <iframe
                                     src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14609.131739736918!2d90.4076468!3d23.7372879!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4be9e304803d052a!2sCinebaz%20Limited!5e0!3m2!1sen!2sbd!4v1631897501459!5m2!1sen!2sbd"
                                      class="cinebaz-google-location" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/6147177bd326717cb6823c12/1ffur7fgb';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
@endpush
@push('headcss')
    <style>
        .tawk-card .tawk-card-inverse .tawk-card-xsmall .tawk-footer .tawk-flex-none {
            display: none !important;

        }

        .live-chat:hover {
            color: #fff;
        }

    </style>
@endpush
