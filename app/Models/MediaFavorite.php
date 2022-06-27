<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cinebaz\Media\Models\Media;

class MediaFavorite extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'media_favorites';
    //protected $guarded = [];
    protected $fillable = [
        'media_id', 'member_id', 'browser_session', 'member_ip',
        'remarks', 'sort_by', 'is_active', 'create_by', 'modified_by'
    ];

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
