<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vedio extends Model
{
    use HasFactory;


    protected $table = 'vedio';

    protected $fillable = [
        'vedio_id',
        'user_id',
        'vedio_title',
        'vedio',
        'vedio_type',
        'vedio_veiw_count',
        'vedio_ext',
        'vedio_status',
        'thumbnails',
    ];
}
