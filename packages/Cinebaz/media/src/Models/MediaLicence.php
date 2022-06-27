<?php

namespace Cinebaz\Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaLicence extends Model
{
    use HasFactory;
    protected $table = 'media_licences';
    protected $fillable = [
        'order_id',  'member_id','media_id', 'purchases_date', 'deadline', 'video_type'
    ];
}
