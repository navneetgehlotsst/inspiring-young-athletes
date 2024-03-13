<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TokenHistory extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'token_redeem_history';

    protected $fillable = [
        'token_id',
        'reedem_date',
        'amount',
        'status',
    ];
}
