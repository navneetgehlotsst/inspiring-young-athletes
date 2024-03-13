<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodWillToken extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'goodwill_token';

    protected $fillable = [
        'bussiness_id',
        'token_amount',
        'createdby',
        'comment',
        'status'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'createdby');
    }
}
