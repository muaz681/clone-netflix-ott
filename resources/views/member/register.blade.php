@extends('layouts.master')
@section('content')
<!-- Sign in Start -->
<section class="sign-in-page" style="padding-top:60px;height:auto;background-color: #191919">
    <div class="container">
        <div class="row justify-content-center align-items-center height-self-center">
            <div class="col-lg-8 col-md-12 align-self-center">
                <div class="sign-user_card ">
                    <div class="sign-in-page-data">
                        <div class="sign-in-from w-100 m-auto">
                            <h3 class="mb-6 text-center">{{__("Sign-Up")}}</h3>
                            <p class="d-flex justify-content-center links" style="width: 100%;">
                                {{__('Already-have-an-account')}}? <a href="{{ route('member.auth.showlogin',app()->getLocale()) }}"
                                    class="text-primary ml-2" style="color:#df861b !important;">{{__('Sign-in')}}</a>
                            </p>
                            <form class="mt-4" method="POST" action="{{ route('member.auth.store',[app()->getLocale()] ) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control mb-0 @error('name') is-invalid @enderror"
                                                name="name" value="{{old('name')}}"  autocomplete="name"
                                                autofocus id="exampleInputText" placeholder="{{__('Enter-Full-Name')}}">
                                                <font style="color:#e60000">
                                                    {{($errors->has('name'))?($errors->first('name')):' '}}
                                                </font>
                                        </div>
                                        <div class="form-group">
                                            <input type="email"
                                                class="form-control mb-0 @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" autocomplete="email"
                                                id="exampleInputEmail2" placeholder="{{__('Enter-Email')}}">
                                                <font style="color:#e60000">
                                                    {{($errors->has('email'))?($errors->first('email')):' '}}
                                              </font>
                                        </div>
                                        <div class="form-group">
                                            <input type="number"
                                                class="form-control mb-0 @error('phone') is-invalid @enderror"
                                                name="phone" value="{{ old('phone') }}" autocomplete="phone"
                                                id="exampleInputPhone2" placeholder="{{__('Enter-Phone-Number')}}">
                                                <font style="color:#e60000">
                                                    {{($errors->has('phone'))?($errors->first('phone')):' '}}
                                              </font>
                                        </div>
                                        <div class="form-group d-flex">
                                            <input type="password" id="exampleInputPassword2"
                                                class="password-width form-control mb-0 @error('password') is-invalid @enderror"
                                                placeholder="{{__('Password')}}" name="password"
                                                autocomplete="new-password" id="customCheck">
                                                <span class="eye-toggle-password">
                                                    <i toggle="#exampleInputPassword2" class="fa fa-fw fa-eye field-icon toggle-password eye-password"></i>
                                                 </span>
                                                <font style="color:#e60000">
                                                    {{($errors->has('password'))?($errors->first('password')):' '}}
                                              </font>
                                        </div>
                                        <div class="form-group">
                                            <input id="password-confirm" type="password"
                                                class="form-control mb-0 @error('password') is-invalid @enderror"
                                                name="password_confirmation" placeholder="{{__('Confirm-Password')}}"
                                                autocomplete="new-password">
                                                <font style="color:#e60000">
                                                    {{($errors->has('password_confirmation'))?($errors->first('password_confirmation')):' '}}
                                              </font>
                                        </div>
                                        <div class="row m-0">
                                            <div class="form-check col-4">
                                                <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="Male" checked="">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    {{__("Male")}}
                                                </label>
                                            </div>
                                            <div class="form-check col-4">
                                                <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="Female">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                {{__("Female")}}
                                                </label>
                                            </div>
                                            <div class="form-check col-4">
                                                <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault3" value="Others">
                                                <label class="form-check-label" for="flexRadioDefault3">
                                                {{__("others")}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3 m-0">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn sign-in-button">{{__("Sign-Up")}}</button>
                                    </div>

                                </div>
                            </form>
                            {{--  --}}
                            {{-- <div class="row mt-3">
                                <div class="col-md-12 text-center">
                                    <h4>{{__("OR")}}</h4>
                                </div>
                            </div> --}}
                            <div class="row social-register" style="text-align: center;">
                                <div class="col-md-12 py-3">
                                    <p class="d-flex justify-content-center links" style="width: 100%;">
                                        {{__("Login-with")}}
                                    </p>
                                    {{-- <a href="{{ route('login.facebook',app()->getLocale() ) }}" class="btn btn-info btn-block">
                                        <i class="fa fa-facebook"></i> Facebook
                                    </a> --}}


                                </div>
                                <div class="col-md-4 col-sm-12 my-2">
                                    <a href="{{ route('login.otp',app()->getLocale() ) }}" class="register-otp">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                        width="28" height="28"
                                        viewBox="0 0 48 48"
                                        style=" fill:#000000;">
                                        <path fill="#0f0" d="M13,42h22c3.866,0,7-3.134,7-7V13c0-3.866-3.134-7-7-7H13c-3.866,0-7,3.134-7,7v22	C6,38.866,9.134,42,13,42z"></path>
                                        <path fill="#fff" d="M35.45,31.041l-4.612-3.051c-0.563-0.341-1.267-0.347-1.836-0.017c0,0,0,0-1.978,1.153	c-0.265,0.154-0.52,0.183-0.726,0.145c-0.262-0.048-0.442-0.191-0.454-0.201c-1.087-0.797-2.357-1.852-3.711-3.205	c-1.353-1.353-2.408-2.623-3.205-3.711c-0.009-0.013-0.153-0.193-0.201-0.454c-0.037-0.206-0.009-0.46,0.145-0.726	c1.153-1.978,1.153-1.978,1.153-1.978c0.331-0.569,0.324-1.274-0.017-1.836l-3.051-4.612c-0.378-0.571-1.151-0.722-1.714-0.332	c0,0-1.445,0.989-1.922,1.325c-0.764,0.538-1.01,1.356-1.011,2.496c-0.002,1.604,1.38,6.629,7.201,12.45l0,0l0,0l0,0l0,0	c5.822,5.822,10.846,7.203,12.45,7.201c1.14-0.001,1.958-0.248,2.496-1.011c0.336-0.477,1.325-1.922,1.325-1.922	C36.172,32.192,36.022,31.419,35.45,31.041z"></path>
                                    </svg>
                                    <span>
                                       Sign up with OTP
                                    </span> 
                                    </a>
                                </div>
                                <div class="col-md-4 col-sm-12 my-2">
                                    <a href="{{ route('login.google',app()->getLocale() ) }}" class="register-google">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                            width="28" height="28"
                                            viewBox="0 0 48 48"
                                            style=" fill:#000000;">
                                            <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
                                            <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
                                            <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
                                            <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                                        </svg>
                                        <span>
                                           Sign up with Google
                                        </span> 
                                    </a>
                                </div>
                                <div class="col-md-4 col-sm-12 my-2">
                                    <a href="{{ route('login.apple',app()->getLocale()) }}" class="register-apple">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                            width="28" height="28"
                                            viewBox="0 0 30 30"
                                            style=" fill:#000000;">    
                                            <path d="M25.565,9.785c-0.123,0.077-3.051,1.702-3.051,5.305c0.138,4.109,3.695,5.55,3.756,5.55 c-0.061,0.077-0.537,1.963-1.947,3.94C23.204,26.283,21.962,28,20.076,28c-1.794,0-2.438-1.135-4.508-1.135 c-2.223,0-2.852,1.135-4.554,1.135c-1.886,0-3.22-1.809-4.4-3.496c-1.533-2.208-2.836-5.673-2.882-9 c-0.031-1.763,0.307-3.496,1.165-4.968c1.211-2.055,3.373-3.45,5.734-3.496c1.809-0.061,3.419,1.242,4.523,1.242 c1.058,0,3.036-1.242,5.274-1.242C21.394,7.041,23.97,7.332,25.565,9.785z M15.001,6.688c-0.322-1.61,0.567-3.22,1.395-4.247 c1.058-1.242,2.729-2.085,4.17-2.085c0.092,1.61-0.491,3.189-1.533,4.339C18.098,5.937,16.488,6.872,15.001,6.688z"></path>
                                        </svg>
                                        <span>
                                            Sign up with Apple
                                        </span>
                                    </a>
                                </div>
                            </div>
                            {{--  --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign in END -->
        <!-- color-customizer -->
    </div>
</section>
<!-- Sign in END -->
@endsection
@push('scripts')

@endpush
