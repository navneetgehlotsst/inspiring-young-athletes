<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserIncome extends Model
{
    use HasFactory;


    protected $table = 'user_incomes';

    protected $fillable = [
        'user_id',
        'videorevenue',
        'referralrevenue',
        'month',
        'years'
    ];
}
