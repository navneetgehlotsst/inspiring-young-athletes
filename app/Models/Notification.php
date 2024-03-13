<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'notification';

    protected $fillable = [
        'target_id',
        'user_id',
        'message',
        'date',
        'time',
        'target_page',
        'read_at',
    ];

}