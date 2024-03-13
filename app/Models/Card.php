<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GiftToken extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'gift_token';

    protected $fillable = [
        'bussiness_id',
        'token_amount',
        'token_validaty',
        'comment',
        'status',
        'hide_token',
        'shared_id',
        'token_shared',
        'token_code',
        'createdby'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'createdby');
    }

    public function tokenHistory()
    {
        return $this->hasMany(TokenHistory::class, 'token_id', 'id');
    }
}
