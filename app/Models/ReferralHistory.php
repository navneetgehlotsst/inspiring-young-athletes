<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralHistory extends Model
{
    use HasFactory;


    protected $table = 'referralhistory';

    protected $fillable = [
        'referral_by',
        'referral_to',
        'status',
    ];
}
