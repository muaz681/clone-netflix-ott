
    <li class="slide-item category-slide-item">
        <a href="{{ route('frontend.free', [app()->getLocale()]) }}" class="add-banner-logo-text d-flex">
            <span>{{__("FREE")}}</span>
        </a>
    </li>
    <li class="slide-item category-slide-item">
        <a href="{{ route('frontend.upcoming', [app()->getLocale()]) }}" class="add-banner-logo-text d-flex">
            <span>{{__("Upcoming")}}</span>
        </a>
    </li>
    <li class="slide-item category-slide-item">
        <a href="{{ route('frontend.premium', [app()->getLocale()]) }}" class="add-banner-logo-text d-flex">
            <span>{{__('Premium')}}</span>
        </a>
    </li>
    <li class="slide-item category-slide-item">
        <a href="{{ route('frontend.trending', [app()->getLocale()]) }}" class="add-banner-logo-text d-flex">
            <span>{{__('Trending')}}</span>
        </a>
    </li>
    @foreach (TVShow() as $tvShow_nav)
    <li class="slide-item category-slide-item">
        <a href="{{ route('frontend.media_list', [app()->getLocale(), $tvShow_nav->slug]) }}" class="add-banner-logo-text d-flex">
            <span>{{ $tvShow_nav->title_english }}</span>
        </a>
    </li>
    @endforeach
{{-- @endisset --}}

