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
        'video_from'
    ];


    public function videoHistory()
    {
        return $this->hasMany(VideoHistory::class,'video_id','video_id');
    }


    public function videoHistoryMonth()
    {
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Get the previous month and year
        $previousMonth = date('m', strtotime('-1 month'));
        $previousYear = date('Y', strtotime('-1 month'));
        return $this->hasMany(VideoHistory::class, 'video_id','video_id')->whereYear('created_at',$currentYear)->whereMonth('created_at',$currentMonth);
    }


    public function videoHistoryYears()
    {
        $currentYear = date('Y');

        // Get the previous month and year
        $previousYear = date('Y', strtotime('-1 month'));
        return $this->hasMany(VideoHistory::class, 'video_id','video_id')->whereYear('created_at',$currentYear);
    }
}
