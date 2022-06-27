<?php

namespace App\Models;
use Cinebaz\Tag\Models\Media;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaArtistOcccupation extends Model
{
    use HasFactory;
    // public function artists()
    // {
    //     return $this->belongsToMany(Media::class,'media_id','id');
    // }
}
