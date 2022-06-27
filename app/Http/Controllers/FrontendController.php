<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Cinebaz\Category\Models\Category;
use Cinebaz\Seo\Models\Seo;
use Cinebaz\Media\Models\Media;
use App\Models\OrderDetails;
use App\Models\MediaFavorite;
use App\Models\MediaListing;
use App\Models\MediaSimilar;
use App\Models\PlayListLog;
use App\Models\TopTen;
use App\Models\Tranding;
use App\Models\Pricing;
use App\Models\Quality;
use App\Models\SubscriptionHead;
use App\Models\PlanHead;
use App\Models\AssignPlan;


use App\Models\Member;
use Cinebaz\Notification\Models\UserNotification;
use App\Notifications\MemberNotification;

use App\Models\Season;
use Cinebaz\Genre\Models\Genre;
use Illuminate\Http\Request;
use Session;
use DB;
use Mail;
use PhpParser\Node\Stmt\Echo_;
use App\Models\Artist;
use Illuminate\Support\Facades\Cache;
use App\Models\MediaArtistOcccupation;
use Carbon\Carbon;
use Cinebaz\Banner\Models\Slider;
use Cinebaz\Banner\Models\SliderDetail;

class FrontendController extends Controller
{

    private $member;
    public function __construct()
    {
        $this->redirectTo = url()->previous();
        $this->member =  auth('member')->user();

    }
    public function index()
    {
        $member = $this->member;

        Session::put('redirectUrl', url()->current());

        $mdata['seo'] = cache()->remember('home-seo', 60 * 5, function () {
            return Seo::where('title', 'home-page')->first();
        });
        $mdata['slider'] = $this->getSlider('home-slider');
        $mdata['section']['free'] = [
            'name' => 'Free Movies',
            'link' => null,
            'data' =>  $this->getFree()
        ];
        $mdata['section']['premium'] = [
            'name' => 'Premium Movies',
            'link' => null,
            'data' =>  $this->getPremium()
        ];
        $mdata['section']['combo'] = [
            'name' => 'Combo',
            'link' => null,
            'data' =>  $this->getCombo()
        ];

        $mdata['section']['tvshow'] = [
            'name' => 'Web Series',
            'link' => null,
            'data' =>  $this->getTvShow()
        ];
        $mdata['section']['drama'] = [
            'name' => 'Free Drama',
            'link' => null,
            'data' =>  $this->getDrama()
        ];

        $mdata['section']['upcoming'] = [
            'name' => 'Upcoming Movies',
            'link' => url('en/category/upcoming-1'),
            'data' =>  $this->getUpcomming()
        ];

        $mdata['section']['favorites'] = [
                'name' => 'Your Favorites',
                'link' => null,
                'data' =>  $this->getFavorite()];

        $mdata['section']['wishlist'] = [
                'name' => 'Your Wishlist',
                'link' => null,
                'data' =>  $this->getWishlist()];

        $mdata['section']['history'] = [
                'name' => 'Play History',
                'link' => null,
                'data' =>  $this->getPlayHistory()];

        $mdata['section']['suggested'] = [
                'name' => 'Suggested For You',
                'link' => null,
                'data' =>  $this->getSuggested()];

        $mdata['section']['suggested'] = [
                'name' => 'My Purchase',
                'link' => null,
                'data' =>  $this->getMyPurchase()];

        if ($member) {
            $mdata['member']['favorites'] = $mdata['favorites']['data']->pluck('media_id')->toArray();
            $mdata['member']['listing'] = $mdata['listing']['data']->pluck('media_id')->toArray();
            $mdata['member']['history'] = $mdata['history']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['member']['favorites'] = [];
            $mdata['member']['listing'] = [];
            $mdata['member']['history'] = [];
        }

        $mdata['categories']['name']    = "Categories";
        $mdata['categories']['data']    = cache()->remember('home-categories', 60 * 5, function () {
            return Category::where('page_show', 1)->get();
        });
        return view('index')->with($mdata);
    }
    public function movies()
    {
        Session::put('redirectUrl', url()->current());
        $seo      = new Seo();
        $seo->meta_title        = 'Cinebaz';
        $seo->meta_description  = 'Cinebaz';
        $seo->meta_keywords     = 'Cinebaz';
        $seo->canonical_url     = 'Cinebaz';
        $seo->seo_image         = 'Cinebaz';
        $mdata['seo']           = $seo;
        $member = auth('member')->user();

        // ->with('featured','featuredL')
        $mdata['categories']    = Category::where('category_nature', 1)->where('page_show', 1)->get();
        foreach($mdata['categories'] as $val){
                ($val->medias);
             foreach( $val->medias as $media){
                 ($media->featuredL->small);
             }
        }

        // $mdata['catMedias'] = $mdata['categories']->medias()->with('featured','featuredL')->get();
        // dd($mdata['categories']->medias());
        // foreach($mdata['categories'] as $val){
        //     $mdata['catMedias'] = $val->medias()->with('featured','featuredL')->get();
            //  foreach( $val->medias as $media){
            //      ($media->featuredL->small);
            //  }
        // }

        $mdata['cat_slider']    = Media::where('video_nature_id', 1)
            ->inRandomOrder()
            ->take(3)
            ->get();
            $mdata['section']['free'] = [
                'name' => 'Free',
                'link' => null,
                'data' =>  $this->getFree()
            ];
            $mdata['section']['premium'] = [
                'name' => 'Premium Movies',
                'link' => null,
                'data' =>  $this->getPremium()
            ];

            $mdata['section']['upcoming'] = [
                'name' => 'Upcoming Movies',
                'link' => url('en/category/upcoming-1'),
                'data' =>  $this->getUpcomming()
            ];
        // $mdata['categories'] = Category::where('menu_show', true)->get();
// dd($mdata);
        if ($member) {
            $mdata['favorites']['name'] = 'Your Favorites';
            $mdata['favorites']['data'] = MediaFavorite::where(['member_id' => $member->id])
                ->inRandomOrder()
                ->take(10)
                ->get();
            $mdata['member']['favorites'] = $mdata['favorites']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['favorites']['name'] = null;
            $mdata['favorites']['data'] = null;
            $mdata['member']['favorites'] = [];
        }

        if ($member) {
            $mdata['listing']['name'] = 'Your Listing';
            $mdata['listing']['data'] = MediaListing::where(['member_id' => $member->id])
                ->inRandomOrder()
                ->take(10)
                ->get();
            $mdata['member']['listing'] = $mdata['listing']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['listing']['name'] = null;
            $mdata['listing']['data'] = null;
            $mdata['member']['listing'] = [];
        }
        $fdata['fdata'] = null;
        // dd($mdata['categories']);
        return view('movie_category')->with($mdata);
    }
    public function movie_all()
    {
        Session::put('redirectUrl', url()->current());
        $seo      = new Seo();
        $seo->meta_title        = 'Cinebaz';
        $seo->meta_description  = 'Cinebaz';
        $seo->meta_keywords     = 'Cinebaz';
        $seo->canonical_url     = 'Cinebaz';
        $seo->seo_image         = 'Cinebaz';
        $mdata['seo']           = $seo;
        $member = auth('member')->user();


        $mdata['categories']    = Category::where('category_nature', 1)->where('page_show', 1)->get();
        foreach($mdata['categories'] as $val){
            ($val->medias);
         foreach( $val->medias as $media){
             ($media->featuredL->small);
         }
    }
        $mdata['cat_slider']    = Media::where('video_nature_id', 1)
            ->inRandomOrder()
            ->take(3)
            ->get();
        // $mdata['categories'] = Category::where('menu_show', true)->get();

        if ($member) {
            $mdata['favorites']['name'] = 'Your Favorites';
            $mdata['favorites']['data'] = MediaFavorite::where(['member_id' => $member->id])
                ->inRandomOrder()
                ->take(10)
                ->get();
            $mdata['member']['favorites'] = $mdata['favorites']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['favorites']['name'] = null;
            $mdata['favorites']['data'] = null;
            $mdata['member']['favorites'] = [];
        }

        if ($member) {
            $mdata['listing']['name'] = 'Your Listing';
            $mdata['listing']['data'] = MediaListing::where(['member_id' => $member->id])
                ->inRandomOrder()
                ->take(10)
                ->get();
            $mdata['member']['listing'] = $mdata['listing']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['listing']['name'] = null;
            $mdata['listing']['data'] = null;
            $mdata['member']['listing'] = [];
        }
        $fdata['fdata'] = null;

        return view('upcoming')->with($mdata);
    }
    public function mediaList($lang, $slug)
    {
        Session::put('redirectUrl', url()->current());
        // $mdata['seo']       = Seo::get();
        $mdata['cat']       = Category::where('slug', $slug)->where('is_active','Yes')->first();
        $mdata['catMedias'] = $mdata['cat']->medias()->with('featured','featuredL')->whereNull('is_season_parent')
        ->get();
        // foreach($mdata['cat']->medias->where('is_active','Yes') as $val){
        //     dump($val);
        //  foreach( $val-> as $medi){
        //      dump($medi);
        //  }
        // }
        $mdata['seo']       = $mdata['cat']->seo;

        $member = auth('member')->user();
        if ($member) {
            $mdata['favorites']['name'] = 'Your Favorites';
            $mdata['favorites']['data'] = cache()->remember('home-favorites-' . $member->id, 60 * 5, function () use ($member) {
                return MediaFavorite::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['favorites'] = $mdata['favorites']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['favorites']['name'] = null;
            $mdata['favorites']['data'] = null;
            $mdata['member']['favorites'] = [];
        }

        if ($member) {
            $mdata['listing']['name'] = 'Your Listing';
            $mdata['listing']['data'] = cache()->remember('my-short-listing-' . $member->id, 60 * 5, function () use ($member) {
                return MediaListing::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['listing'] = $mdata['listing']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['listing']['name'] = null;
            $mdata['listing']['data'] = null;
            $mdata['member']['listing'] = [];
        }
        // dd($mdata);
        return view('page.list_page')->with($mdata);
    }
    // Free Movie Section
    public function free()
    {
        $member = auth('member')->user();
        $mdata['free']['name'] = 'Free';
        $mdata['free']['data'] =  $this->getFree();
        $mdata['slider'] = $this->getSlider('free-slider');

        if ($member) {
            $mdata['favorites']['name'] = 'Your Favorites';
            $mdata['favorites']['data'] = cache()->remember('home-favorites-' . $member->id, 60 * 5, function () use ($member) {
                return MediaFavorite::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['favorites'] = $mdata['favorites']['data']->pluck('media_id')->toArray();


            $mdata['listing']['name'] = 'Your Wishlist';
            $mdata['listing']['data'] = cache()->remember('my-short-listing-' . $member->id, 60 * 5, function () use ($member) {
                return MediaListing::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['listing'] = $mdata['listing']['data']->pluck('media_id')->toArray();

            $mdata['history']['name'] = 'Play History';
            $mdata['history']['data'] =  cache()->remember('my-short-history-' . $member->id, 60 * 5, function () use ($member) {
                return PlayListLog::where(['member_id' => $member->id])
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get()
                    ->unique('video_id');
            });
            $mdata['member']['history'] = $mdata['history']['data']->pluck('media_id')->toArray();

            $mdata['suggested']['name'] = 'Suggested For You';
            $mdata['suggested']['data'] =  cache()->remember('my-short-suggested-' . $member->id, 60 * 5, function () use ($member) {
                return PlayListLog::where(['member_id' => $member->id])
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get()
                    ->unique('video_id');
            });


            $mdata['bucketList']['name'] = 'My Purchase ';
            $mdata['bucketList']['data'] =  cache()->remember('my-short-bucketList-' . $member->id, 60 * 5, function () use ($member) {
                return OrderDetails::where(['member_id' => $member->id])->where('status', 'Paid')->get();
            });
        } else {
            $mdata['favorites']['name'] = null;
            $mdata['favorites']['data'] = null;
            $mdata['member']['favorites'] = [];

            $mdata['listing']['name'] = null;
            $mdata['listing']['data'] = null;
            $mdata['member']['listing'] = [];

            $mdata['history']['name'] = null;
            $mdata['history']['data'] = null;
            $mdata['member']['history'] = [];

            $mdata['suggested']['name'] = 'Suggested For You';
            $mdata['suggested']['data'] = [];

            $mdata['bucketList']['name'] = null;
            $mdata['bucketList']['data'] = null;
        }
        return view('page.free')->with($mdata);
    }
    // Free Movie Section End
    // Trending Movie Section
    public function trending()
    {
        $member = auth('member')->user();
        $mdata['trandings']['data'] = $this->getTrending(10);
        $mdata['trandings']['name'] = 'Trending';
        $mdata['slider'] = $this->getSlider('trending-slider');
        if ($member) {
            $mdata['favorites']['name'] = 'Your Favorites';
            $mdata['favorites']['data'] = cache()->remember('home-favorites-' . $member->id, 60 * 5, function () use ($member) {
                return MediaFavorite::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['favorites'] = $mdata['favorites']['data']->pluck('media_id')->toArray();


            $mdata['listing']['name'] = 'Your Wishlist';
            $mdata['listing']['data'] = cache()->remember('my-short-listing-' . $member->id, 60 * 5, function () use ($member) {
                return MediaListing::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['listing'] = $mdata['listing']['data']->pluck('media_id')->toArray();

            $mdata['history']['name'] = 'Play History';
            $mdata['history']['data'] =  cache()->remember('my-short-history-' . $member->id, 60 * 5, function () use ($member) {
                return PlayListLog::where(['member_id' => $member->id])
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get()
                    ->unique('video_id');
            });
            $mdata['member']['history'] = $mdata['history']['data']->pluck('media_id')->toArray();

            $mdata['suggested']['name'] = 'Suggested For You';
            $mdata['suggested']['data'] =  cache()->remember('my-short-suggested-' . $member->id, 60 * 5, function () use ($member) {
                return PlayListLog::where(['member_id' => $member->id])
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get()
                    ->unique('video_id');
            });


            $mdata['bucketList']['name'] = 'My Purchase ';
            $mdata['bucketList']['data'] =  cache()->remember('my-short-bucketList-' . $member->id, 60 * 5, function () use ($member) {
                return OrderDetails::where(['member_id' => $member->id])->where('status', 'Paid')->get();
            });
        } else {
            $mdata['favorites']['name'] = null;
            $mdata['favorites']['data'] = null;
            $mdata['member']['favorites'] = [];

            $mdata['listing']['name'] = null;
            $mdata['listing']['data'] = null;
            $mdata['member']['listing'] = [];

            $mdata['history']['name'] = null;
            $mdata['history']['data'] = null;
            $mdata['member']['history'] = [];

            $mdata['suggested']['name'] = 'Suggested For You';
            $mdata['suggested']['data'] = [];

            $mdata['bucketList']['name'] = null;
            $mdata['bucketList']['data'] = null;
        }
        return view('page.tranding')->with($mdata);
    }
    // Trending Movie Section End
    // Upcoming Movie Section
    public function upcoming()
    {
        $member = auth('member')->user();
        $mdata['upcoming']['name'] = 'Upcoming Movies';
        $mdata['upcoming']['data'] = $this->getUpcomming();
        $mdata['slider'] = $this->getSlider('upcoming-slider');
        if ($member) {
            $mdata['favorites']['name'] = 'Your Favorites';
            $mdata['favorites']['data'] = cache()->remember('home-favorites-' . $member->id, 60 * 5, function () use ($member) {
                return MediaFavorite::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['favorites'] = $mdata['favorites']['data']->pluck('media_id')->toArray();


            $mdata['listing']['name'] = 'Your Wishlist';
            $mdata['listing']['data'] = cache()->remember('my-short-listing-' . $member->id, 60 * 5, function () use ($member) {
                return MediaListing::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['listing'] = $mdata['listing']['data']->pluck('media_id')->toArray();

            $mdata['history']['name'] = 'Play History';
            $mdata['history']['data'] =  cache()->remember('my-short-history-' . $member->id, 60 * 5, function () use ($member) {
                return PlayListLog::where(['member_id' => $member->id])
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get()
                    ->unique('video_id');
            });
            $mdata['member']['history'] = $mdata['history']['data']->pluck('media_id')->toArray();

            $mdata['suggested']['name'] = 'Suggested For You';
            $mdata['suggested']['data'] =  cache()->remember('my-short-suggested-' . $member->id, 60 * 5, function () use ($member) {
                return PlayListLog::where(['member_id' => $member->id])
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get()
                    ->unique('video_id');
            });


            $mdata['bucketList']['name'] = 'My Purchase ';
            $mdata['bucketList']['data'] =  cache()->remember('my-short-bucketList-' . $member->id, 60 * 5, function () use ($member) {
                return OrderDetails::where(['member_id' => $member->id])->where('status', 'Paid')->get();
            });
        } else {
            $mdata['favorites']['name'] = null;
            $mdata['favorites']['data'] = null;
            $mdata['member']['favorites'] = [];

            $mdata['listing']['name'] = null;
            $mdata['listing']['data'] = null;
            $mdata['member']['listing'] = [];

            $mdata['history']['name'] = null;
            $mdata['history']['data'] = null;
            $mdata['member']['history'] = [];

            $mdata['suggested']['name'] = 'Suggested For You';
            $mdata['suggested']['data'] = [];

            $mdata['bucketList']['name'] = null;
            $mdata['bucketList']['data'] = null;
        }
        //  dd($mdata);
        return view('page.upcoming')->with($mdata);
    }
    // Upcoming Movie Section End
    // Premium Movie Section
    public function premium()
    {
        $member = auth('member')->user();
        $mdata['premium']['name'] = 'Premium Movies';
        $mdata['premium']['data'] = $this->getPremium();
        $mdata['slider'] = $this->getSlider('premium-slider');

        if ($member) {
            $mdata['favorites']['name'] = 'Your Favorites';
            $mdata['favorites']['data'] = cache()->remember('home-favorites-' . $member->id, 60 * 5, function () use ($member) {
                return MediaFavorite::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['favorites'] = $mdata['favorites']['data']->pluck('media_id')->toArray();


            $mdata['listing']['name'] = 'Your Wishlist';
            $mdata['listing']['data'] = cache()->remember('my-short-listing-' . $member->id, 60 * 5, function () use ($member) {
                return MediaListing::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['listing'] = $mdata['listing']['data']->pluck('media_id')->toArray();

            $mdata['history']['name'] = 'Play History';
            $mdata['history']['data'] =  cache()->remember('my-short-history-' . $member->id, 60 * 5, function () use ($member) {
                return PlayListLog::where(['member_id' => $member->id])
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get()
                    ->unique('video_id');
            });
            $mdata['member']['history'] = $mdata['history']['data']->pluck('media_id')->toArray();

            $mdata['suggested']['name'] = 'Suggested For You';
            $mdata['suggested']['data'] =  cache()->remember('my-short-suggested-' . $member->id, 60 * 5, function () use ($member) {
                return PlayListLog::where(['member_id' => $member->id])
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get()
                    ->unique('video_id');
            });


            $mdata['bucketList']['name'] = 'My Purchase ';
            $mdata['bucketList']['data'] =  cache()->remember('my-short-bucketList-' . $member->id, 60 * 5, function () use ($member) {
                return OrderDetails::where(['member_id' => $member->id])->where('status', 'Paid')->get();
            });
        } else {
            $mdata['favorites']['name'] = null;
            $mdata['favorites']['data'] = null;
            $mdata['member']['favorites'] = [];

            $mdata['listing']['name'] = null;
            $mdata['listing']['data'] = null;
            $mdata['member']['listing'] = [];

            $mdata['history']['name'] = null;
            $mdata['history']['data'] = null;
            $mdata['member']['history'] = [];

            $mdata['suggested']['name'] = 'Suggested For You';
            $mdata['suggested']['data'] = [];

            $mdata['bucketList']['name'] = null;
            $mdata['bucketList']['data'] = null;
        }

        return view('page.premium')->with($mdata);
    }
    // Premium Movie Section End
    public function upcomingMediaList($id)
    {
        Session::put('redirectUrl', url()->current());
        // $mdata['seo']       = Seo::get();
        $mdata['cat']       = Category::where('slug', $id)->first();
        $mdata['seo']       = $mdata['cat']->seo;

        $member = auth('member')->user();
        if ($member) {
            $mdata['favorites']['name'] = 'Your Favorites';
            $mdata['favorites']['data'] = cache()->remember('home-favorites-' . $member->id, 60 * 5, function () use ($member) {
                return MediaFavorite::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['favorites'] = $mdata['favorites']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['favorites']['name'] = null;
            $mdata['favorites']['data'] = null;
            $mdata['member']['favorites'] = [];
        }

        if ($member) {
            $mdata['listing']['name'] = 'Your Listing';
            $mdata['listing']['data'] = $this->getListing($member);
            $mdata['member']['listing'] = $mdata['listing']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['listing']['name'] = null;
            $mdata['listing']['data'] = null;
            $mdata['member']['listing'] = [];
        }
        return view('page.upcoming_list_page')->with($mdata);
    }
    public function TVShow($lang)
    {
        Session::put('redirectUrl', url()->current());
        $seo      = new Seo();
        $seo->meta_title        = 'Cinebaz';
        $seo->meta_description  = 'Cinebaz';
        $seo->meta_keywords     = 'Cinebaz';
        $seo->canonical_url     = 'Cinebaz';
        $seo->seo_image         = 'Cinebaz';
        $mdata['seo']           = $seo;
        $member = auth('member')->user();
        if ($member) {
            $mdata['favorites']['name'] = 'Your Favorites';
            $mdata['favorites']['data'] = cache()->remember('home-favorites-' . $member->id, 60 * 5, function () use ($member) {
                return MediaFavorite::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['favorites'] = $mdata['favorites']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['favorites']['name'] = null;
            $mdata['favorites']['data'] = null;
            $mdata['member']['favorites'] = [];
        }

        if ($member) {
            $mdata['listing']['name'] = 'Your Listing';
            $mdata['listing']['data'] = cache()->remember('my-short-listing-' . $member->id, 60 * 5, function () use ($member) {
                return MediaListing::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['listing'] = $mdata['listing']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['listing']['name'] = null;
            $mdata['listing']['data'] = null;
            $mdata['member']['listing'] = [];
        }
        $mdata['section']['tvshow'] = [
            'name' => 'Web Series',
            'link' => null,
            'data' =>  $this->getTvShow()
        ];
        $mdata['section']['drama'] = [
            'name' => 'Drama',
            'link' => null,
            'data' =>  $this->getDrama()
        ];
        $mdata['cat_slider']    = Media::where('video_nature_id', 2)
            ->where('is_season_parent', 0)
            ->inRandomOrder()
            ->take(3)
            ->get();
        $fdata['fdata'] = null;
        return view('category')->with($mdata, $fdata);
    }
    public function plan()
    {
        Session::put('redirectUrl', url()->current());
        $seo      = new Seo();
        $seo->meta_title        = 'Cinebaz';
        $seo->meta_description  = 'Cinebaz';
        $seo->meta_keywords     = 'Cinebaz';
        $seo->canonical_url     = 'Cinebaz';
        $seo->seo_image         = 'Cinebaz';
        $mdata['seo']           = $seo;
        //$data['competitors'] = Category::where('menu_show', '1')->get();
        //$mdata['prices'] = Pricing::all();
        $mdata['SubHead']   = SubscriptionHead::where('deleted_at', Null)->get();
        $mdata['PHead']     = PlanHead::where('deleted_at', Null)->get();
        $mdata['Assign']    = new AssignPlan();
        //dd($mdata);
        $fdata['fdata'] = null;
        return view('pricing')->with($mdata);
    }
    public function season()
    {
        Session::put('redirectUrl', url()->current());
        $seo      = new Seo();
        $seo->meta_title        = 'Cinebaz';
        $seo->meta_description  = 'Cinebaz';
        $seo->meta_keywords     = 'Cinebaz';
        $seo->canonical_url     = 'Cinebaz';
        $seo->seo_image         = 'Cinebaz';
        $mdata['seo']           = $seo;

        $mdata['mdata'] = null;
        $fdata['fdata'] = null;
        return view('season')->with($mdata, $fdata);
    }
    public function series()
    {
        Session::put('redirectUrl', url()->current());
        $seo      = new Seo();
        $seo->meta_title        = 'Cinebaz';
        $seo->meta_description  = 'Cinebaz';
        $seo->meta_keywords     = 'Cinebaz';
        $seo->canonical_url     = 'Cinebaz';
        $seo->seo_image         = 'Cinebaz';
        $mdata['seo']           = $seo;

        $mdata['mdata'] = null;
        $fdata['fdata'] = null;

        return view('series')->with($mdata, $fdata);
    }
    public function details(Request $request, $lang, $slug)
    {

       


        Session::put('redirectUrl', url()->current());
        $media = Media::where(['slug' => $slug])->firstOrFail();
        $mdata['seo'] = $media->seo;
        $mdata['mdata'] = $media;
        $member = $this->member;

        if ($member) {
            $mdata['favorites']['name'] = 'Your Favorites';
            $mdata['favorites']['data'] = cache()->remember('home-favorites-' . $member->id, 60 * 5, function () use ($member) {
                return MediaFavorite::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['favorites'] = $mdata['favorites']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['favorites']['name'] = null;
            $mdata['favorites']['data'] = null;
            $mdata['member']['favorites'] = [];
        }

        if ($member) {
            $mdata['listing']['name'] = 'Your Listing';
            $mdata['listing']['data'] = $this->getListing($member);
            $mdata['member']['listing'] = $mdata['listing']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['listing']['name'] = null;
            $mdata['listing']['data'] = null;
            $mdata['member']['listing'] = [];
        }

        $mdata['upcoming']['name']  = 'Upcoming Movies';
        $mdata['upcoming']['data'] = $this->getUpcomming();

        $mdata['recomended']['name']  = 'Recommended';
        $mdata['recomended']['data'] = null; //$this->getRecomended();


        $mdata['similer']['name']    = 'Similer Videos';
        $mdata['similer']['data']    =  $this->getSimilar($media);

        if ($member) {
            $mdata['checkCart'] = OrderDetails::where('member_id', $member->id)->where('media_id', $mdata['mdata']->id)->first();
        }


        if($media->video_nature_id == 4){ //4 for combo t
            return view('page.combo')->with($mdata);
            // return view('page.web_series')->with($mdata);
        }elseif($media->video_nature_id == 2){ // 2 for Web Series
            return view('page.web_series')->with($mdata);
        }else{
            return view('page.details')->with($mdata);
            // return view('page.web_series')->with($mdata);
        }

    }
    public function start($lang, $slug)
    {
        // return $slug;
        Session::put('redirectUrl', url()->current());
        $member = auth('member')->user();
        $media = Media::where(['slug' => $slug])->where('published_status', 1)->firstOrFail();

        $mdata['seo'] = ($media) ? $media->seo : null;

        $mdata['last_time']     = PlayListLog::where(['video_id' => $media->id, 'member_id' =>  $member->id])->latest()->first();

        $order = OrderDetails::where(['media_id' =>  $media->id, 'member_id' => $member->id])->latest()->first();

        if ($media->video_url) {

            $mdata['video'] = $media->video_url;

            $myBucket        = OrderDetails::where('media_id', $media->id)->get();
            if (!$myBucket) {
                $myBucket    = Media::where(['slug' => $slug])->where('premium', 1)->where('published_status', 1)->first();
            }

            if ($media && $myBucket) {


                $mdata['mdata'] = $media;

                $existing = PlayListLog::where(['video_id' => $media->id, 'member_id' =>  auth('member')->user()->id])
                    ->whereDate('created_at', date('Y-m-d'))
                    ->first();
                $playlog = [
                    'video_id'      => $media->id,
                    'member_id'     => auth('member')->user()->id,
                    'ip'     => $this->getIp(),
                    'session_id'     => Session::getId(),
                    'pre_time'  => ($mdata['last_time']) ? $mdata['last_time']->last_watchtime : null,
                    'last_watchtime'    => ($existing) ? $existing->last_watchtime : (($mdata['last_time']) ? $mdata['last_time']->last_watchtime : null),
                    'order_id' => ($media->premium && $order) ? $order->id : null,
                    'is_premium' => $media->premium
                ];

                // dd($playlog);

                try {

                    // dd($playlog);


                    if ($existing) {
                        PlayListLog::where('id', $existing->id)->update($playlog);
                    } else {
                        // dd($playlog);

                        $mdata['last_time'] = PlayListLog::create($playlog);
                    }
                } catch (\Illuminate\Database\QueryException $ex) {
                    dd($ex->getMessage());
                    return redirect()->back()->withErrors($ex->getMessage())
                        ->with('myexcep', $ex->getMessage())->withInput();
                }
                // dd($mdata);
                return view('page.start')->with($mdata)->with('success', 'Successfully save changed');
            } else {
                notify()->error('Please add The media on bucket !');
                return redirect()->back();
            }
        } else {
            notify()->error('Media hasn`t published !');
            return redirect()->back();
        }
    }
    public function readNotification($id)
    {

        $notification   = DB::table('notifications')->where('id', $id)->first();
        $upData         = DB::table('notifications')->where('id', $id)->update(['read_at' => now()]);
        $arr            = json_decode($notification->data);
        if ($arr->link) {
            return redirect()->to($arr->link);
        } else {
            return redirect()->back();
        }
    }
    public function ajax_favorite($lang ,$id)
    {
        $reslul = ['click' => 'add', 'count' => null];
        $ip = trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
        $media = Media::findOrFail($id);
        $user = auth('member')->user();

        $attFind = [
            'media_id' => $id,
            'member_id' => ($user) ? $user->id : null
        ];

        $existing = MediaFavorite::where($attFind)->first();

        if ($existing) {
            MediaFavorite::where($attFind)->delete();
            $reslul['click'] = 'remove';
            if (Cache::has('home-favorites-' . $user->id)) {
                Cache::forget('home-favorites-' . $user->id);
            }
            if (Cache::has('my-favorites-all-' .  $user->id)) {
                Cache::forget('my-favorites-all-' . $user->id);
            }
        } else {
            //dd($attributes);
            $insert = new MediaFavorite;

            $insert->media_id           = (int)$id;
            $insert->member_id          = ($user) ? $user->id : null;
            $insert->browser_session    = null;
            $insert->member_ip          = ($ip) ? $ip : null;

            $insert->save();

            $reslul['click'] = 'add';
            if (Cache::has('home-favorites-' . $user->id)) {
                Cache::forget('home-favorites-' . $user->id);
            }
            if (Cache::has('my-favorites-all-' .  $user->id)) {
                Cache::forget('my-favorites-all-' . $user->id);
            }
        }
        return response()->json($reslul);
        //dump($user);
        // dd($media);
    }
    public function ajax_listing($lang ,$id)
    {
        $reslul = ['click' => 'add', 'count' => null];
        $ip     = trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
        $media  = Media::findOrFail($id);
        $user   = auth('member')->user();

        $attFind = [
            'media_id' => $id,
            'member_id' => ($user) ? $user->id : null
        ];

        $existing = MediaListing::where($attFind)->first();

        if ($existing) {
            MediaListing::where($attFind)->delete();
            $reslul['click'] = 'remove';
            if (Cache::has('my-short-listing-' . $user->id)) {
                Cache::forget('my-short-listing-' . $user->id);
            }
            if (Cache::has('my-list-vedio-all-' .  $user->id)) {
                Cache::forget('my-list-vedio-all-' . $user->id);
            }
        } else {
            $insert = new MediaListing;
            $insert->media_id = (int)$id;
            $insert->member_id = ($user) ? $user->id : null;
            $insert->browser_session = null;
            $insert->member_ip = ($ip) ? $ip : null;
            $insert->save();
            $reslul['click'] = 'add';
            if (Cache::has('my-short-listing-' . $user->id)) {
                Cache::forget('my-short-listing-' . $user->id);
            }
            if (Cache::has('my-list-vedio-all-' .  $user->id)) {
                Cache::forget('my-list-vedio-all-' . $user->id);
            }
        }
        return response()->json($reslul);
    }
    public function ajax_search(Request $request)
    {
        $data =  Media::search($request->q)->take(6)->get();
        $html = '<ul>';

        foreach ($data as $list) {
            $html .= '<li><a href="' . route('frontend.details', [app()->getLocale(), $list->slug]) . '">';
            $html .=  $list->title_en;
            $html .=  '</a></li>';
        }
        $html .= '</ul>';
        return response()->json(['data' => $html]);
        //dd($data);
    }
    public function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }

    // private function getDrama($isAll = null)
    // {

    //     if ($isAll) {
    //         return cache()->remember('drama-all', 60 * 5, function () {
    //             return Media::where('is_active', 'Yes')
    //                 ->where(function ($query) {
    //                     $query->whereNull('published_at');
    //                     $query->orWhere('published_at', '>',  Carbon::now('Asia/Dhaka'));
    //                 })
    //                 ->inRandomOrder()
    //                 ->with('featured')->get();
    //         });
    //     } else {
    //         return cache()->remember('drama-limit', 60 * 5, function () {
    //             return Media::where('is_active', 'Yes')
    //                 ->where(function ($query) {
    //                     $query->whereNull('published_at');
    //                     $query->orWhere('published_at', '>',  Carbon::now('Asia/Dhaka'));
    //                 })
    //                 ->inRandomOrder()
    //                 ->take(12)
    //                 ->with('featured')->get();
    //         });
    //     }
    // }
    public function generMediaList($lang, $slug)
    {
        Session::put('redirectUrl', url()->current());
        $mdata['seo'] = Seo::get();
        $member = auth('member')->user();
        if ($member) {
            $mdata['favorites']['name'] = 'Your Favorites';
            $mdata['favorites']['data'] = cache()->remember('home-favorites-' . $member->id, 60 * 5, function () use ($member) {
                return MediaFavorite::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['favorites'] = $mdata['favorites']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['favorites']['name'] = null;
            $mdata['favorites']['data'] = null;
            $mdata['member']['favorites'] = [];
        }

        if ($member) {
            $mdata['listing']['name'] = 'Your Listing';
            $mdata['listing']['data'] = cache()->remember('my-short-listing-' . $member->id, 60 * 5, function () use ($member) {
                return MediaListing::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['listing'] = $mdata['listing']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['listing']['name'] = null;
            $mdata['listing']['data'] = null;
            $mdata['member']['listing'] = [];
        }
        $mdata['gener_media_list']  = Genre::where('slug', $slug)->first();
        $mdata['catMedias'] = $mdata['gener_media_list']->medias()->with('featured','featuredL')->whereNull('is_season_parent')->get();
        // dd($mdata['catMedias']);
        $mdata['seo']               = $mdata['gener_media_list']->seo;

        return view('page.gener_media_list')->with($mdata);
    }



    public function savePlayHistory(Request $request)
    {
        // dd($request);

        $existing = PlayListLog::where(['video_id' => $request->media_id, 'member_id' =>  auth('member')->user()->id])
            ->whereDate('created_at', date('Y-m-d'))
            ->first();
        try {
            $playlog = [
                'video_id'      => $request->media_id,
                'member_id'     => auth('member')->user()->id,
                'ip'     => $this->getIp(),
                'session_id'     => Session::getId(),
                'last_watchtime'    => $request->last_time,
            ];
            if ($existing) {
                // dd($playlog);
                PlayListLog::where('id', $existing->id)->update($playlog);
                return response()->json([
                    'success' => true,
                    'message' => 'Timer Updated',
                ]);
            } else {
                PlayListLog::create($playlog);
                return response()->json([
                    'success' => true,
                    'message' => 'PlayLog added',
                ]);
            }
        } catch (\Illuminate\Database\QueryException $ex) {

            return response()->json([
                'is_loging'     => false,
                'access_token'  => null,
                'token_type'    => null,
                'expires_in'    => null,
                'massege'       => 'Unauthorized'
            ], 401);
        }
    }

    public function artistProfile($lang, $slug)
    {

        $artist = Artist::where('slug', $slug)->first();
        return view('page.artist-profile', [
            'artist' => $artist
        ]);
    }

    

    private function getUpcomming($isAll = false)
    {

        if ($isAll) {
            return cache()->remember('upcoming-media-all', 60 * 5, function () {
                return Media::where('is_active', 'Yes')
                    ->where(function ($query) {
                        $query->whereNull('published_at');
                        $query->orWhere('published_at', '>',  Carbon::now('Asia/Dhaka'));
                    })
                    ->inRandomOrder()
                    ->with('featured','featuredL')->get();
            });
        } else {
            return cache()->remember('upcoming-media', 60 * 5, function () {
                return Media::where('is_active', 'Yes')
                    ->where(function ($query) {
                        $query->whereNull('published_at');
                        $query->orWhere('published_at', '>',  Carbon::now('Asia/Dhaka'));
                    })
                    ->inRandomOrder()
                    ->take(12)
                    ->with('featured','featuredL')->get();
            });
        }
    }
    // $mdata['recomended']['name']    = 'Recommended';
    //     $mdata['recomended']['data']    = Media::whereNotNull('video_url')
    //                 ->whereNull('is_season_parent')
    //                 ->where('video_nature_id', '!=',4)
    //                 ->orderby('id', 'DESC')->get();
    // private function getRecomended($isAll = false)
    // {

    //     if ($isAll) {
    //         return cache()->remember('recomended-media-all', 60 * 5, function () {
    //             return Media::whereNotNull('video_url')
    //                 ->whereNull('is_season_parent')
    //                 ->where('video_nature_id', '!=',4)
    //                 ->with('featured','featuredL')->get();
    //         });
    //     } else {
    //         return cache()->remember('recomended-media', 60 * 5, function () {
    //             return Media::whereNotNull('video_url')
    //                 ->whereNull('is_season_parent')
    //                 ->where('video_nature_id', '!=',4)
    //                 ->take(12)
    //                 ->with('featured','featuredL')->get();
    //         });
    //     }
    // }
    private function getTvShow($isAll = false)
    {

        if ($isAll) {
            return cache()->remember('home-tvshow-all-', 60 * 5, function () {
                return Media::where('premium', '1')
                    ->where('published_at', '<', Carbon::now('Asia/Dhaka'))
                    ->where('is_active', 'Yes')
                    ->where('video_nature_id', 2)
                    ->where('is_season_parent', 0)
                    ->inRandomOrder()

                    ->with('featured','featuredL')->get();
            });
        } else {
            return cache()->remember('home-tvshow-10-', 60 * 5, function () {
                return Media::where('premium', '1')
                    ->where('published_at', '<', Carbon::now('Asia/Dhaka'))
                    ->where('is_active', 'Yes')
                    ->where('video_nature_id', 2)
                    ->where('is_season_parent', 0)
                    ->inRandomOrder()
                    ->take(10)
                    ->with('featured','featuredL')->get();
            });
        }
    }
    private function getCombo($isAll = false)
    {

        if ($isAll) {
            return cache()->remember('home-combo-all-', 60 * 5, function () {
                return Media::where('premium', '1')
                    ->where('published_at', '<', Carbon::now('Asia/Dhaka'))
                    ->where('is_active', 'Yes')
                    ->where('video_nature_id', 4)
                    ->inRandomOrder()

                    ->with('featured','featuredL')->get();
            });
        } else {
            return cache()->remember('home-combo-10-', 60 * 5, function () {
                return Media::where('premium', '1')
                    ->where('published_at', '<', Carbon::now('Asia/Dhaka'))
                    ->where('is_active', 'Yes')
                    ->where('video_nature_id', 4)
                    ->inRandomOrder()
                    ->take(10)
                    ->with('featured','featuredL')->get();
            });
        }
    }


    private function getDrama($isAll = false)
    {


        if ($isAll) {
            return cache()->remember('home-drama-free-all-', 60 * 5, function () {
                return Media::where('premium', '0')
                    ->where('published_at', '<', Carbon::now('Asia/Dhaka'))
                    ->where('is_active', 'Yes')
                    ->where('video_nature_id', 3)
                    ->inRandomOrder()

                    ->with('featured','featuredL')->get();
            });
        } else {
            return cache()->remember('home-drama-free-10-', 60 * 5, function () {
                return Media::where('premium', '0')
                    ->where('published_at', '<', Carbon::now('Asia/Dhaka'))
                    ->where('is_active', 'Yes')
                    ->where('video_nature_id', 3)
                    ->inRandomOrder()
                    ->take(10)
                    ->with('featured','featuredL')->get();
            });
        }
    }
    private function getFree($isAll = false)
    {


        if ($isAll) {
            return cache()->remember('home-free-all-', 60 * 5, function () {
                return Media::where('premium', '0')
                    ->where('published_at', '<', Carbon::now('Asia/Dhaka'))
                    ->where('is_active', 'Yes')
                    ->where('video_nature_id', 1)
                    ->inRandomOrder()
                    ->with('featured','featuredL')->get();
            });
        } else {
            return cache()->remember('home-free-10-', 60 * 5, function () {
                return Media::where('premium', '0')
                    ->where('published_at', '<', Carbon::now('Asia/Dhaka'))
                    ->where('is_active', 'Yes')
                    ->where('video_nature_id', 1)
                    ->inRandomOrder()
                    ->take(10)
                    ->with('featured','featuredL')->get();
            });
        }
    }
    private function getPremium($isAll = false)
    {
        if ($isAll) {
            return cache()->remember('home-premium-all', 60 * 5, function () {
                return Media::where('premium', 1)
                    ->where('is_active', 'Yes')
                    ->where('published_at', '<', Carbon::now('Asia/Dhaka'))
                    ->whereNotNull('video_url')
                    ->whereNull('is_season_parent')
                    ->where('video_nature_id', '!=',4)
                    ->inRandomOrder()
                    ->take(10)
                    ->with('featured','featuredL')->get();
            });
        } else {
            return cache()->remember('home-premium-10', 60 * 5, function () {
                return Media::where('premium', 1)
                    ->where('is_active', 'Yes')
                    ->where('published_at', '<', Carbon::now('Asia/Dhaka'))
                    ->whereNotNull('video_url')
                    ->whereNull('is_season_parent')
                    ->where('video_nature_id', '!=',4)
                    ->inRandomOrder()
                    ->take(10)
                    ->with('featured','featuredL')->get();
            });
        }
    }
    private function getFavorite($isAll = false)
    {

        $member = $this->member;
        if($member){
            if ($isAll) {
                return cache()->remember('home-favorites-all-' . $member->id, 60 * 5, function () use ($member) {
                    return MediaFavorite::where(['member_id' => $member->id])
                        ->inRandomOrder()
                        ->get();
                });
            } else {
                return cache()->remember('home-favorites-10-' . $member->id, 60 * 5, function () use ($member) {
                    return MediaFavorite::where(['member_id' => $member->id])
                        ->inRandomOrder()
                        ->take(10)
                        ->get();
                });
            }
        }
        return [];

    }
    private function getWishlist($isAll = false)
    {

        $member = $this->member;
        if($member){
            if ($isAll) {
                return cache()->remember('my-short-listing-all-' . $member->id, 60 * 5, function () use ($member) {
                    return MediaListing::where(['member_id' => $member->id])
                        ->inRandomOrder()
                        ->get();
                });
            } else {

                return cache()->remember('my-short-listing-10-' . $member->id, 60 * 5, function () use ($member) {
                    return MediaListing::where(['member_id' => $member->id])
                        ->inRandomOrder()
                        ->take(10)
                        ->get();
                });

            }
        }
        return [];

    }
    private function getSuggested($isAll = false)
    {

        $member = $this->member;
        if($member){
            if ($isAll) {
                return cache()->remember('my-short-suggested-all-' . $member->id, 60 * 5, function () use ($member) {
                    return PlayListLog::where(['member_id' => $member->id])
                        ->orderBy('created_at', 'desc')
                        ->get()
                        ->unique('video_id');
                });
            } else {
                return cache()->remember('my-short-suggested-10-' . $member->id, 60 * 5, function () use ($member) {
                    return PlayListLog::where(['member_id' => $member->id])
                        ->orderBy('created_at', 'desc')
                        ->take(10)
                        ->get()
                        ->unique('video_id');
                });

            }
        }
        return [];

    }
    private function getMyPurchase($isAll = false)
    {

        $member = $this->member;
        if($member){
            if ($isAll) {
                return cache()->remember('my-short-bucketList-all' . $member->id, 60 * 5, function () use ($member) {
                    return OrderDetails::where(['member_id' => $member->id])->where('status', 'Paid')->get();
                });
            } else {
                return cache()->remember('my-short-bucketList-10' . $member->id, 60 * 5, function () use ($member) {
                    return OrderDetails::where(['member_id' => $member->id])
                    ->where('status', 'Paid')
                    ->take(10)
                    ->get();
                });
            }
        }
        return [];

    }
    private function getPlayHistory($isAll = false)
    {

        $member = $this->member;
        if($member){
            if ($isAll) {
                return cache()->remember('my-short-history-all-' . $member->id, 60 * 5, function () use ($member) {
                    return PlayListLog::where(['member_id' => $member->id])
                        ->orderBy('created_at', 'desc')
                        ->get()
                        ->unique('video_id');
                });
            } else {

                return cache()->remember('my-short-history-10-' . $member->id, 60 * 5, function () use ($member) {
                    return PlayListLog::where(['member_id' => $member->id])
                        ->orderBy('created_at', 'desc')
                        ->take(10)
                        ->get()
                        ->unique('video_id');
                });

            }
        }
        return [];

    }
    private function getSlider($slug, $limit = 5, $orderBy = 'DESC')
    {
        return cache()->remember('sqlSlider-' . $slug . $limit, 60 * 5, function () use ($slug, $limit, $orderBy) {

            return  Slider::where('slug', $slug)
                ->orderBy('created_at', $orderBy)->take($limit)
                ->first();
        });
    }

    private function getTrending($limit = null)
    {

        $today = Carbon::now()->toDateString();

        $mdata = cache()->remember('tranding-' . $limit, 60 * 5, function () use ($limit, $today) {
            $data = Tranding::where('start_date', '<=', $today)
                ->where('deadline', '>=', $today)->orderBy('created_at', 'DESC');
            if ($limit) {
                $data = $data->take($limit);
            }
            $data = $data->get();
            $reslul = collect(new Media());
            foreach ($data as $list) {
                $reslul->add($list->media);
            }

            return $reslul;
        });
        return $mdata;
    }
    private function getSimilar($media){
       return cache()->remember('similar-media-'.$media->id , 60 * 5, function () use ($media) {
            return  Media::select('media.*')
            ->join('media_similars as rt', 'rt.similar_id', '=', 'media.id')
            ->where(['rt.media_id' => $media->id])
            ->inRandomOrder()
            ->take(10)->with('featured','featuredL')
            ->get();

        });
  
    }
    private function getListing($member){
        return cache()->remember('my-list-vedio-all-' . $member->id, 60 * 5, function () use ($member) {
            return Media::select('media.*')
            ->join('media_listings as rt', 'rt.media_id', '=', 'media.id')
            ->where(['rt.member_id' => $member->id])
            ->groupBy('rt.media_id')   
            ->with('featured','featuredL')
            ->get();
            });
     }
    private function sectionGenarate()
    {

    }
    public function download_android()
    {

        return redirect()->away('https://play.google.com/store/apps/details?id=com.app.shaplamedia');

        // return Redirect::to('https://play.google.com/store/apps/details?id=com.app.shaplamedia');
    }


}
