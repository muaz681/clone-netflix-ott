<?php

namespace Cinebaz\Media\Models;

use Cinebaz\Category\Models\Category;
use Cinebaz\Genre\Models\Genre;
use Cinebaz\Seo\Models\Seo;
use Cinebaz\Tag\Models\Tag;
use Cinebaz\Series\Models\Series;
use Cinebaz\Season\Models\Season;
use Cinebaz\Media\Models\MediaSimilar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use App\Models\Artist;
use App\Models\Occupation;
use App\Models\MediaArtistOcccupation;
use App\Models\Tranding;

class Media extends Model
{
    use Searchable;
    use HasFactory;
    use SoftDeletes;
    protected $table = 'media';
    protected $fillable = [
        'title_en',  'title_bn', 'title_hn', 'slug', 'description_en', 'description_bn', 'description_hn',
        'short_description_en', 'short_description_bn', 'short_description_hn', 'age_limit', 'duration', 'release_year',
        'video_type', 'premium', 'published_status', 'starring', 'trailer_url', 'video_url', 'youtube_url', 'thumbnil_portrait', 'thumbnil_landscape',
        'remarks', 'sort_by', 'is_active', 'create_by', 'modified_by', 'video_nature_id', 'series_id', 'session_id'
    ];
    // php artisan scout:import "Cinebaz\Media\Models\Media"
    // public function searchableAs()
    // {
    //     return 'media_index';
    // }

    public function episodes()
    {
        return $this->belongsToMany(Media::class, 'media_seasons','season_id', 'media_id')->orderBy('published_at','asc');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'media_category');
    }
    public function occupations()
    {
        return $this->belongsToMany(Occupation::class, 'media_artist_occcupations' , 'media_id' , 'occupation_id');
    }
    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'media_artist_occcupations' , 'media_id' , 'artist_id');
    }
    public function similars()
    {
        return $this->hasMany(MediaSimilar::class);
    }

    public function suggested()
    {
        return $this->belongsToMany(Media::class, 'media_similars');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'media_tag');
    }
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'media_genre');
    }
    public function combo()
    {
        return $this->belongsToMany(Media::class, 'media_combos','media_id', 'combo_id');
    }


    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
    // images relation
    public function featured()
    {
        return $this->morphOne(Picture::class, 'imageable')->where('image_type', 1)->latest();
    }
    public function featuredL()
    {
        return $this->morphOne(Picture::class, 'imageable')->where('image_type', 2)->latest();
    }
    public function logo()
    {
        return $this->morphOne(Picture::class, 'imageable')->where('image_type', 3)->latest();
    }
    public function certificate()
    {
        return $this->morphOne(Picture::class, 'imageable')->where('image_type', 4)->latest();
    }

    public function images()
    {
        return $this->morphMany(Picture::class, 'imageable')->where('image_type', 0)->latest();
    }
    public function allimages()
    {
        return $this->morphMany(Picture::class, 'imageable')->latest();
    }

    // end images relation
    static function getSeries($id)
    {
        return  Series::where('id', $id)->first();
    }
    static function getSession($id)
    {
        return  Season::where('id', $id)->first();
    }
}