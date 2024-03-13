<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessOperation extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'business_operations';

    protected $fillable = [
        'user_id',
        'business_day',
        'open_time',
        'close_time'
    ];
}
