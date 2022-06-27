@extends('layouts.security')

@section('seq_content')

  <!-- Sign in Start -->
   <section class="sign-in-page" style="height:auto;background-color: #191919;">
      <div class="container">
         <div class="row justify-content-center align-items-center height-self-center">
            <div class="col-lg-5 col-md-12 align-self-center">
               @if (isset($status))
               <div class="alert alert-success text-center">
                <p class="pt-3">Email sent successfully !<br/>
                Please check your mail to reset your password.</p>
               </div> 
               @else
               <!-- @if (session('fail'))
               <div class="alert alert-danger">
                  {{ session('fail') }}
               </div>
               @endif -->
               <div class="sign-user_card ">
                  
                  <div class="sign-in-page-data">
                     <div class="sign-in-from w-100 m-auto">
                        <h4 class="mb-3 text-center">Forgot Password</h4>
                        
                        <form class="mt-4" method="POST" action="{{route('forgot-password', app()->getLocale())}}">
                           @csrf
                           <small class="text-center">Enter your email registered with Cinebaz Limited</small>
                           <div class="form-group">
                              <input type="email" class="form-control mb-0 @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus id="exampleInputEmail2" placeholder="Registered email" >
                              @error('email')
                                 <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                 </span>
                              @enderror
                           </div>
                           <div class="sign-info justify-content-center">
                              <button type="submit" class="btn btn-primary">Sent</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               @endif
            </div>
         </div>
      <!-- Sign in END -->
      </div>
   </section>
@endsection
