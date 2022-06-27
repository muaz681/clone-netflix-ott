<?php

namespace Cinebaz\Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaCombo extends Model
{
    use HasFactory;

    public function media()
    {
        return $this->belongsTo(Media::class, 'combo_id', 'id');
    }
    static function mediaCombo($media_id){
        return MediaCombo::where('media_id',$media_id)->get();
    }
    
}
