<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessFavorite extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'business_favorite';

    protected $fillable = [
        'bussiness_id',
        'user_id',
        'status',
    ];
}
