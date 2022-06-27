<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Artist;

class Occupation extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function artist()
    {
    return  $this->belongsToMany('Artist');
    }

    public function artists()
    {   
        return $this->belongsTo(Artist::class, 'media_artist_occcupations' , 'artist_id' , 'occupation_id');
    }
}
