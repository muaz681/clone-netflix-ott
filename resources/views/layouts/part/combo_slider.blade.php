@foreach($combos['data'] as $k => $combo)
<li class="slide-item">
    <div class="block-images position-relative">
        <div class="img-box slider-img-box">
            
                <div class="block-social-info">
                    <ul class="list-inline p-0 m-0 music-play-lists">
                        <li>
                            <span class="active">
                                <i class="ri-heart-fill"></i>
                            </span>
                        </li>
                        <li>
                            <span
                                class="active">
                                <i class="ri-add-line"></i></span>
                        </li>
                    </ul>
                </div>
                @php
                    $count_media = \DB::table('combo_media')->select('media_id')->where('combo_id',$combo->id)->count(); 
                @endphp
                <span class="premium-tag">
                    <span class="planbox__header__strike-through">{{$count_media * 10}}</span>
                    <span>BDT. {{$combo->price}}</span>
                </span>
            
            <a href="{{route('details',$combo->slug)}}">
                <img data-original="{{ asset('assets/frontend/images/noimage-p.png') }}"
                        src="{{ ($combo->thumbnail) ? asset('storage/'.$combo->thumbnail) : url('assets/frontend/images/noimage-p.png') }}" class="img-fluid" alt="">
            </a>
        </div>

        <div class="block-description">
                <div class="hover-buttons">
                        <a href="javascript:void(0)" onclick="">
                            <span class="btn btn-warning">
                                <i class="fa fa-shopping-cart mr-1" aria-hidden="true"></i>
                            </span>
                        </a>
                </div>
            


            <h6 class="hover-heading">
                <a href="#">
                    Combo
                </a>
            </h6>
        </div>

    </div>
</li>
@endforeach
