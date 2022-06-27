@extends('layouts.security')

@section('seq_content')

  <!-- Sign in Start -->
   <section class="m-profile setting-wrapper">
      <div class="container-fluid">
         <div class="row">
             <div class="col-lg-3">
                <div class="library-full_card">
                    <div class="sign-user_card text-center">
                        <div class="image-change">
                            @if(count($user->images)>0)
                                <img src="{{url('storage/'.$user->images[0]->thumbnail)}}" class="img-fluid d-block mx-auto mb-3" alt="{{$user->name}}" id="image">
                            @else
                                <img src="{{ Gravatar::src('https://www.gravatar.com/avatar/', 150) }}" class="img-fluid d-block mx-auto mb-3" alt="{{$user->name}}" id="image">
                                {{--  <img src="https://visualpharm.com/assets/30/User-595b40b85ba036ed117da56f.svg" class="img-fluid d-block mx-auto mb-3" alt="{{$user->name}}" id="image">  --}}
                            @endif

                               
                        </div>
                        <h4 class="mb-3">{{ $user->name }}</h4>
                        @include('member.profile.common.member-profile-menu')
                    </div>
                </div>
             </div>
            <div class="col-lg-9">
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

                  <div class="sign-in-page-data">
                     <div class="sign-in-from w-100 m-auto">
                        <h3 class="mb-3 text-center">Change PassWord</h3>
                        <form class="mt-4" method="POST" action="{{ route('member.auth.updatePassword',[app()->getLocale()]) }}">
                           @csrf
                            <div class="form-group">
                                <input type="password" class="form-control mb-0 @error('old_password') is-invalid @enderror" name="old_password"  required placeholder="Enter Old Password">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control mb-0 @error('password') is-invalid @enderror" name="new_password" required placeholder="New Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control mb-0 @error('re_password') is-invalid @enderror" name="re_password" required placeholder="Re-type Password">
                                @error('re_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="sign-info">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      <!-- Sign in END -->
      </div>
   </section>
@endsection
