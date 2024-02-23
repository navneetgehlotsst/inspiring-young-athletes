<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoCommentHistory extends Model
{
    use HasFactory;


    protected $table = 'video_comment_history';

    protected $fillable = [
        'video_id',
        'comment',
    ];
}
