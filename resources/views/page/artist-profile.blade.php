
@extends('layouts.master')
@push('styles')
<link rel="stylesheet" href="{{ url('assets/frontend/artist-profile/style.css') }}" />
@endpush
@section('content')
<section>
<div style="padding-top:75px">
    <img src="{{url('images/ArtistProfile.jpg')}}" alt="image" style="width:100% ; height:250px"/>
</div>
</section>
<div class="profile-img-body" >          
<img src="{{($artist->image) ? asset('storage/'.$artist->image) : url('images/c-avatar.png')}}"  class="img-fluid"/>
</div>
<div class="profile-artist-name" >          
    <h1>{{$artist->name}}</h1>
    <h3 class="mt-2">{{$artist->company}}</h3>
</div>

<section class="single-page" style="padding-top:100px"> 
<div class="container mb-4  d-flex justify-content-center ">
    <div class="row col-md-12">
        <div class="profile-artist-about col-md-8" >          
            <h1>About</h1>
            <p class="mt-3">{{$artist->description}}</p>
        </div>

            
        <div class="profile-infos col-md-4 mt-5  p-3" style="width:500px;height:auto; background:#000;color:#ffffff">
            <h2><strong style="color:#ffffff;font-size:26px;">Information</strong></h2>
            <table class="table table-borderless mt-2" id="artist-table">
                    <tr>
                        <td width="45%"><strong>Date of Birth </strong></td>
                        <td width="5%">:</td>
                        <td width="45%">{{date('j F, Y', strtotime($artist->dob))}}</td>
                    </tr>
                    <tr>
                        <td width="45%"><strong>Nationality &nbsp;&nbsp; &nbsp;&nbsp; </strong></td>
                        <td width="5%">:</td>
                        <td width="45%">{{$artist->nationality}}</td>
                    </tr>
                    <tr>
                        <td width="45%"><strong>Education &nbsp;&nbsp; &nbsp;&nbsp; </strong></td>
                        <td width="5%">:</td>
                        <td width="45%">{{$artist->education}}</td>
                    </tr>
                    <tr>
                        <td width="45%"><strong>Occupation &nbsp;&nbsp; &nbsp;&nbsp; </strong></td>
                        <td width="5%">:</td>
                        <td width="45%">
                            @forelse($artist->occupations as $key => $ocuupation)
                               {{ $key != 0 ? ',' : '' }} {{$ocuupation->title}}
                            @empty  
                                - - -
                            @endforelse
                        </td>
                    </tr>
                    <tr>
                        <td width="45%"><strong>Years Active  </strong></td>
                        <td width="5%">:</td>
                        <td width="45%">{{$artist->years_active}}</td>
                    </tr>
                    <tr>
                        <td width="45%"><strong>Marital Status  </strong></td>
                        <td width="5%">:</td>
                        <td width="45%">{{$artist->marital_status}}</td>
                    </tr>
                    <tr>
                        <td width="45%"><strong>Spouse(s)  &nbsp;&nbsp; &nbsp;&nbsp; </strong></td>
                        <td width="5%">:</td>
                        <td width="45%">{{$artist->spouse}}</td>
                    </tr>
                    <tr>
                        <td width="45%"><strong>Awards  &nbsp;&nbsp; &nbsp;&nbsp; </strong></td>
                        <td width="5%">:</td>
                        <td width="45%" style="text-align:justify">{{$artist->awards}}</td>
                    </tr>
            </table>
        </div>  
    </div>
   
  </div>   
</div>
</section> 
@endsection
@push('scripts') 
@endpush
