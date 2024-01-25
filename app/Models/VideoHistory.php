<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoHistory extends Model
{
    use HasFactory;


    protected $table = 'video_history';

    protected $fillable = [
        'user_id',
        'video_id',
    ];
}
