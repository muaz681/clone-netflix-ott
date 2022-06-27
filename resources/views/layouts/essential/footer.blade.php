<footer class="mb-0 responsive-footer">

    <div class="copyright py-2">
        <div class="container-fluid">
            <img class="payment-logo" src="{{ url('assets/frontend/images/payment.png') }}" />
        </div>
    </div>
    <div class="container-fluid">
        <div class="block-space">

            <div class="row">
                <div class="col-md-4">
                    <a class="footer-social-icon-left"
                        href="//www.dmca.com/Protection/Status.aspx?id=baf20d38-773e-432f-a0f2-f638ceffc5d1"
                        title="DMCA.com Protection Status" class="dmca-badge"> <img
                            src="//images.dmca.com/Badges/-w100-2x1-02.png?ID=baf20d38-773e-432f-a0f2-f638ceffc5d1"
                            alt="DMCA.com Protection Status"></a> <script src="//images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>

                    <div class="text-left footer-social-icon-right pt-3">
                        @isset($setting['facebook'])
                            <a href="{{ $setting['facebook'] }}" class="s-icon"
                                target="_blank">
                                <i class="ri-facebook-fill"></i>
                            </a>
                        @endisset
                        @isset($setting['twitter'])
                            <a href="{{ $setting['twitter'] }}" class="s-icon"
                                target="_blank">
                                <i class="ri-twitter-fill"></i>
                            </a>
                        @endisset
                        @isset($setting['linkedin'])
                            <a href="{{ $setting['linkedin'] }}" class="s-icon"
                                target="_blank">
                                <i class="ri-linkedin-fill"></i>
                            </a>
                        @endisset
                        @isset($setting['google'])
                            <a href="{{ $setting['google'] }}" class="s-icon"
                                target="_blank">
                                <i class="ri-google-fill"></i>
                            </a>
                        @endisset
                        @isset($setting['instagram'])
                            <a href="{{ $setting['instagram'] }}" class="s-icon"
                                target="_blank">
                                <i class="ri-instagram-fill"></i>
                            </a>
                        @endisset
                        @isset($setting['youtube'])
                            <a href="{{ $setting['youtube'] }}" class="s-icon"
                                target="_blank">
                                <i class="ri-youtube-fill"></i>
                            </a>
                        @endisset
                    </div>
                </div>
                <div class="col-md-2">
                    <ul>
                        <li style="color:#fff">
                            <a href="{{ route('frontend.tearms-conditions', [app()->getLocale()]) }}">
                                {{ __('terms-and-conditions') }}
                            </a>
                        </li>
                        <li style="color:#fff"><a
                                href="{{ route('frontend.privacy', [app()->getLocale()]) }}">{{ __('privacy-policy') }}</a>
                        </li>

                        <li style="color:#fff"><a
                                href="{{ route('frontend.legal-notice', [app()->getLocale()]) }}">{{ __('legal-notice') }}</a>
                        </li>
                        <li style="color:#fff"><a
                                href="{{ route('frontend.return-conditions', [app()->getLocale()]) }}">{{ __('return-&-refound-policy') }}</a>
                        </li>
                    </ul>

                </div>

                <div class=" col-md-2">
                    <ul>
                        <li style="color:#fff"><a
                                href="{{ route('frontend.about_us', [app()->getLocale()]) }}">{{ __('about-us') }}</a>
                        </li>
                        <li style="color:#fff"><a
                                href="{{ route('frontend.contact-us', [app()->getLocale()]) }}">{{ __('contact-us') }}</a>
                        </li>
                        <li style="color:#fff"><a
                                href="{{ route('frontend.help-center', [app()->getLocale()]) }}">{{ __('help-center') }}</a>
                        </li>
                        <li style="color:#fff"><a
                                href="{{ route('frontend.corporate-information', [app()->getLocale()]) }}">{{ __('corporate-information') }}</a>
                        </li>
                    </ul>

                </div>


                <div class=" col-md-4">
                    <div class="app-download text-center d-flex">
                        @if (isset($setting['playstore-url']) && isset($setting['playstore']))
                            <a href="{{ route('download_android',[app()->getLocale()]) }}" target="_blank">
                                <img src="{{ asset($setting['playstore']) }}" />
                            </a>
                        @endif
                        @if (isset($setting['appstore-url']) && isset($setting['appstore']))
                            <a href="{{ route('download_ios',[app()->getLocale()])}}" target="_blank">
                                <img src="{{ asset($setting['appstore']) }}" />
                            </a>
                        @endif
                    </div>
                </div>

            </div>


        </div>
    </div>
    <div class="copyright py-2">
        <div class="container-fluid">
            <p class="mb-0 text-center font-size-14 text-body">
                @isset($setting['Copyritght'])
                    {{ $setting['Copyritght'] }}
                @endisset


            </p>
        </div>
    </div>
</footer>
<footer class="iq-footer">
    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col-lg-6">
                <ul class="list-inline mb-0">

                    @foreach (cz_menu('Footer Menu') as $list)
                        <li class="list-inline-item">
                            <a href="{{ $list['link'] }}">{{ $list['label'] }}</a>
                        </li>
                    @endforeach


                </ul>
            </div> -->
            <div class="col-lg-6 text-right">
                @isset($setting['site-copyright'])
                    {!! $setting['site-copyright'] !!}
                @endisset


            </div>
        </div>
    </div>
</footer>

<!-- back-to-top -->
<div id="back-to-top">
    <a class="top" href="#top" id="top"> <i class="fa fa-angle-up"></i> </a>
</div>
<div id="mobile-profile">
    <div class="row mp-row">
        <a href="{{ route('frontend.index') }}" class="col-3 mp-list">
            <i class="fa fa-home" aria-hidden="true"></i><br>
            Home
        </a>
        <a href="{{ route('frontend.movie.all',[app()->getLocale()]) }}" class="col-3 mp-list">
            <i class="fa fa-bolt" aria-hidden="true"></i><br>
            Movie
        </a>
        <a href="{{ route('frontend.free',[app()->getLocale()]) }}" class="col-3 mp-list">
            <i class="fa fa-cloud-download" aria-hidden="true"></i><br>
            Free
        </a>
        <a type="button" class="col-3 mp-list navbar-toggler" data-toggle="collapse"
            data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fa fa-bars" aria-hidden="true"></i><br>
            More
        </a>
    </div>
</div>
