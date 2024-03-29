<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswere extends Model
{
    use HasFactory;


    protected $table = 'user_queston';

    protected $fillable = [
        'user_queston_id',
        'user_id',
        'question_id',
        'user_queston_type',
        'answere_Video',
    ];

    public function IntroVideo()
    {
        return $this->hasMany(Video::class,'video_id','answere_video');
    }


    public function VideoDetail()
    {
        return $this->hasOne(Video::class,'video_id','answere_video');
    }
}
