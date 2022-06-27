<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Occupation;
class Artist extends Model
{
    use HasFactory;
    public function occupations()
    {
      return  $this->belongsToMany(Occupation::class,'artist_occupations');
    }

    public function occupation()
    {   
        return $this->belongsToMany(Occupation::class, 'media_artist_occcupations' , 'artist_id' , 'occupation_id');
    }
}
