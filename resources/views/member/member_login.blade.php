@extends('layouts.master')

@section('content')
  <!-- Sign in Start -->
   <section class="sign-in-page" style="height:auto;background-color: #191919;">
      <div class="container">
         <div class="row justify-content-center align-items-center height-self-center">
            <div class="col-lg-10 col-sm-12 col-md-12 align-self-center">
               @if (session('fail_mail'))
               <div class="alert alert-danger">
                  {{ session('fail_mail') }}
               </div>
               @endif
               @if (session('fail'))
               <div class="alert alert-danger">
                  {{ session('fail') }}
               </div>
               @endif
               <div class="sign-user_card ">
                  <div class="row">
                     <div class="col-md-7 col-sm-12 log-border">
                        <div class="sign-in-page-data">
                           <div class="sign-in-from w-100 m-auto">
                              <h3 class="mb-3 text-center">{{__('Sign-in')}}</h3>
                              <form class="mt-4" method="POST" action="{{ route('member.auth.login',app()->getLocale())}}">
                                 @csrf
                                 <div class="form-group">
                                    <input type="email" class="form-control mb-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus id="exampleInputEmail2" placeholder="{{__('Enter-Email')}}">
                                    @error('email')
                                       <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror
                                 </div>
                                 <div class="form-group d-flex">
                                    <input type="password" id="password-field" class="password-width form-control mb-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="exampleInputPassword2" placeholder="{{__('Password')}}">
                                    <span class="eye-toggle-password">
                                       <i toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password eye-password"></i>
                                    </span>
                                    @error('password')
                                       <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror
                                 </div>
                                 <div class="sign-info">
                                    <button type="submit" class="btn sign-in-button">{{__('Sign-in')}}</button>
                                    <div class="custom-control custom-checkbox d-inline-block">
                                       <input type="checkbox" class="custom-control-input" id="customCheck" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                       <label class="custom-control-label" for="customCheck">{{__('Remember-Me')}}</label>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-5 col-sm-12">
                        <div class="row" style="text-align: center;">
                           <div class="col-md-12">
                              <h4 class="text-center mb-3">{{__('Login-with')}}</h4>
                           </div>
                           <div class="col-md-12 col-sm-12 my-2">
                              <a href="{{ route('login.otp',app()->getLocale() ) }}" class="register-otp">
                                  <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                  width="28" height="28"
                                  viewBox="0 0 48 48"
                                  style=" fill:#000000;">
                                  <path fill="#0f0" d="M13,42h22c3.866,0,7-3.134,7-7V13c0-3.866-3.134-7-7-7H13c-3.866,0-7,3.134-7,7v22	C6,38.866,9.134,42,13,42z"></path>
                                  <path fill="#fff" d="M35.45,31.041l-4.612-3.051c-0.563-0.341-1.267-0.347-1.836-0.017c0,0,0,0-1.978,1.153	c-0.265,0.154-0.52,0.183-0.726,0.145c-0.262-0.048-0.442-0.191-0.454-0.201c-1.087-0.797-2.357-1.852-3.711-3.205	c-1.353-1.353-2.408-2.623-3.205-3.711c-0.009-0.013-0.153-0.193-0.201-0.454c-0.037-0.206-0.009-0.46,0.145-0.726	c1.153-1.978,1.153-1.978,1.153-1.978c0.331-0.569,0.324-1.274-0.017-1.836l-3.051-4.612c-0.378-0.571-1.151-0.722-1.714-0.332	c0,0-1.445,0.989-1.922,1.325c-0.764,0.538-1.01,1.356-1.011,2.496c-0.002,1.604,1.38,6.629,7.201,12.45l0,0l0,0l0,0l0,0	c5.822,5.822,10.846,7.203,12.45,7.201c1.14-0.001,1.958-0.248,2.496-1.011c0.336-0.477,1.325-1.922,1.325-1.922	C36.172,32.192,36.022,31.419,35.45,31.041z"></path>
                              </svg>
                              <span>
                                 Sign in with OTP
                              </span> 
                              </a>
                          </div>
                          <div class="col-md-12 col-sm-12 my-2">
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
                                    Sign in with Google
                                  </span> 
                              </a>
                          </div>
                          <div class="col-md-12 col-sm-12 my-2">
                              <a href="{{ route('login.apple',app()->getLocale()) }}" class="register-apple">
                                  <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                      width="28" height="28"
                                      viewBox="0 0 30 30"
                                      style=" fill:#000000;">    
                                      <path d="M25.565,9.785c-0.123,0.077-3.051,1.702-3.051,5.305c0.138,4.109,3.695,5.55,3.756,5.55 c-0.061,0.077-0.537,1.963-1.947,3.94C23.204,26.283,21.962,28,20.076,28c-1.794,0-2.438-1.135-4.508-1.135 c-2.223,0-2.852,1.135-4.554,1.135c-1.886,0-3.22-1.809-4.4-3.496c-1.533-2.208-2.836-5.673-2.882-9 c-0.031-1.763,0.307-3.496,1.165-4.968c1.211-2.055,3.373-3.45,5.734-3.496c1.809-0.061,3.419,1.242,4.523,1.242 c1.058,0,3.036-1.242,5.274-1.242C21.394,7.041,23.97,7.332,25.565,9.785z M15.001,6.688c-0.322-1.61,0.567-3.22,1.395-4.247 c1.058-1.242,2.729-2.085,4.17-2.085c0.092,1.61-0.491,3.189-1.533,4.339C18.098,5.937,16.488,6.872,15.001,6.688z"></path>
                                  </svg>
                                  <span>
                                    Sign in with Apple
                                  </span>
                              </a>
                          </div>
                          <div class="col-md-12 col-sm-12 my-2">
                           <a href="{{route('login.facebook',app()->getLocale())}}" class="register-apple">
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" x="0px" y="0px" width="28" height="28" viewBox="0 0 50 50" style="null" class="icon icons8-Facebook-Filled" >    <path d="M40,0H10C4.486,0,0,4.486,0,10v30c0,5.514,4.486,10,10,10h30c5.514,0,10-4.486,10-10V10C50,4.486,45.514,0,40,0z M39,17h-3 c-2.145,0-3,0.504-3,2v3h6l-1,6h-5v20h-7V28h-3v-6h3v-3c0-4.677,1.581-8,7-8c2.902,0,6,1,6,1V17z"></path></svg>

                               <span>
                                 Sign in with Facebook
                               </span>
                           </a>
                       </div>
                        </div>
                     </div>
                  </div>
                  

                  

                  <div class="mt-3">
                     <div class="d-flex justify-content-center links">
                        {{__('Do-not-have-an-account')}}? <a href="{{ route('member.auth.register',app()->getLocale()) }}" class="text-primary ml-2" style="color:#df861b !important;">{{__('Sign-Up')}}</a>
                     </div>
                     <div class="d-flex justify-content-center links">
                        <a href="{{route('pass-forgot',app()->getLocale())}}" class="f-link" style="color:#df861b">{{__('Forgot-your-password')}}?</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Sign in END -->
<style>
   .sign-in-page .btn{
      padding:10px !important;
   }
</style>
@endsection
