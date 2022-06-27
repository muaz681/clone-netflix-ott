<?php

namespace Cinebaz\Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    use HasFactory;
    protected $table = 'combos';

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }
}
