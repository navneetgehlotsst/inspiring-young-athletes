<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'payment';

    protected $fillable = [
        'id',
        'user_id',
        'token_id',
        'type',
        'amount',
        'transiction_id',
    ];

}