<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offers extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'offers';

    protected $fillable = [
        'bussiness_id',
        'plan_id',
        'image',
        'text',
        'status'
    ];
}
