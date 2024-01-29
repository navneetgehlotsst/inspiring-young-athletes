<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;


    protected $table = 'video';

    protected $fillable = [
        'video_id',
        'user_id',
        'video_title',
        'video',
        'video_type',
        'video_veiw_count',
        'video_ext',
        'video_status',
        'thumbnails',
    ];
}
